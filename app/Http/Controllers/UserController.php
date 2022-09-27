<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;

use App\Models\Team;
use App\Models\Role;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use App\Repositories\UserRepository;
use App\Repositories\TeamRepository;
use App\Repositories\RoleRepository;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository,
        TeamRepository $teamRepository,
        RoleRepository $roleRepository
    ) {
        $this->userRepository=$userRepository;
        $this->teamRepository=$teamRepository;
        $this->roleRepository=$roleRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=[];
        $users=$this->userRepository->getPageinate(15);
        $teams=$this->teamRepository->getPluck('id','team');
        $roles=$this->roleRepository->getAll();
        $data['title']="使用者維護";
        $data['url']="users";
        $data['page']='index';
        $data['teams']=$teams;
        $data['roles']=$roles;
        $data['users']=$users;

        return view($data['url'].".".$data['page'])->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'tel' => ['nullable','regex:/^([0-9\s\-\+\(\)]*)$/','min:8','max:10'],
            'team' => ['required','numeric'],
            'role' => ['required','numeric'],
            'photofile' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg'],
        ]);
        $input = $request->except('_token');
        $input['password'] = Hash::make($request->password);
        $input['modify_by']= Auth::user()->email;
        $file=$request->file('photofile');
        if(!empty($file)){
            $input['photofile'] = Storage::putFile('', new File($file));
        }
        $data =$this->userRepository->addOne($input, $file);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=[];
        $user=$this->userRepository->getByID($id);
        $teams=$this->teamRepository->getPluck('id','team');
        $roles=$this->roleRepository->getAll();
        $data['user']=$user;
        $data['teams']=$teams;
        $data['roles']=$roles;
        $data['role']=$this->roleRepository->getByID($data['user']['role']);
        $data['title']="使用者維護";
        $data['url']="users";
        $data['page']='show';

        return view($data['url'].".".$data['page'])->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=[];
        $user=$this->userRepository->getByID($id);
        $teams=$this->teamRepository->getPluck('id','team');
        $roles=$this->roleRepository->getAll();
        $data['user']=$user;
        $data['teams']=$teams;
        $data['roles']=$roles;
        $data['role']=$this->roleRepository->getByID($data['user']['role']);
        $data['title']='使用者維護';
        $data['url']="users";
        $data['page']='edit';

        return view($data['url'].".".$data['page'])->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'between:2,10'],
            'tel' => ['nullable','regex:/^([0-9\s\-\+\(\)]*)$/','min:8','max:10'],
            'team' => ['required','numeric'],
            'role' => ['required','numeric'],
            'photofile' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg'],
        ]);
        $input = $request->except('_token', '_method');
        $input['modify_by']= Auth::user()->email;
        $file=$request->file('photofile');
        if(!empty($file)){
            $input['photofile'] = Storage::putFile('', new File($file));
        }
        $data=$this->userRepository->updateOne($input, $id, $file);

        return redirect()->route('users.show', ['user'=> $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $search_id=$this->userRepository->keyWord($request);
        $data=[];
        if(!empty($search_id)){
            $result =$this->userRepository->getByID($search_id);
            foreach ($result as $key => $value) {
                $data[$key]['id']=$value['id'];
                $data[$key]['name']=$value['name'];
            }
        }
        return $data;
    }
}
