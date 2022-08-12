<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Team;
use App\Models\Role;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use App\Repositories\UserRepository;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository=$userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=[];
        $users=User::paginate(15)->toArray();
        $teams=Team::get()->collect()->pluck('team', 'id')->all();
        $roles=Role::get()->toArray();
        $data['title']="使用者維護";
        $data['url']="users";
        $data['page']='index';
        $data['teams']=$teams;
        $data['roles']=$roles;
        $data['users']=$users;
        return view($data['url'].".index")->with('data', $data);
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
        //     $request->validate([
        //         'name' => ['required', 'string', 'max:255'],
        //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
        //         'tel' => ['nullable','numeric','between:8,10'],
        //     ]);
        $input = $request->except('_token');
        $file=$request->file('photofile');
        // dd($input);
        //     $photofile="";
        //     if (!empty($file)) {
        //         $photofile=$file->getClientOriginalName();
        //         $request->photofile->storeAs('images', $photofile, 'public');
        //     }
        //     $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'tel' => $request->tel,
        //     'role' => $request->role,
        //     'team' => $request->team,
        //     'modify_by' => Auth::user()->email,
        //     'modify_time' => date("Y-m-d H:i:s"),
        //     'photofile' => $photofile,
        //   ]);
        //     event(new Registered($user));
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
        $user=User::find($id)->toArray();
        $teams=Team::get()->collect()->pluck('team', 'id')->all();
        $roles=Role::get()->toArray();
        $data['user']=$user;
        $data['teams']=$teams;
        $data['roles']=$roles;
        $data['role']=collect($roles)->pluck('role', 'id')->all()[$data['user']['role']];
        $data['title']="使用者維護";
        $data['url']="users";
        $data['page']='show';
        return view($data['url'].".show")->with('data', $data);
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
        $user=User::find($id)->toArray();
        $teams=Team::get()->collect()->pluck('team', 'id')->all();
        $roles=Role::get()->toArray();
        $data['user']=$user;
        $data['teams']=$teams;
        $data['roles']=$roles;
        $data['role']=collect($roles)->pluck('role', 'id')->all()[$data['user']['role']];
        $data['title']='使用者維護';
        $data['url']="users";
        $data['page']='edit';
        // $data=User::get()->toArray();
        return view($data['url'].".edit")->with('data', $data);
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
        ]);
        $input = $request->except('_token', '_method');
        $data=User::find($id);
        $data->name=$input['name'];
        if ($data->email!=$input['email']) {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
            $data->email=$input['email'];
        } else {
            unset($data->name);
        }

        $data->tel=$input['tel'];
        $data->team=$input['team'];
        $data->role=$input['role'];
        $data->status=$input['status'];
        $data->modify_by=Auth::user()->email;
        $file=$request->file('photofile');
        if (!empty($file)) {
            $data->photofile=$file->getClientOriginalName();
            $request->photofile->storeAs('images', $data->photofile, 'public');
        }
        $data->save();
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
}
