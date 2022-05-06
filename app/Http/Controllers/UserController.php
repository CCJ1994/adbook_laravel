<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ad_team;
use App\Models\Ad_role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data=[];
      $users=User::get()->toArray();
      $teams=Ad_team::get()->toArray();
      $roles=Ad_role::get()->toArray();
      $menus=$this->menus;
      $data['teams']=$teams;
      $data['roles']=$roles;
      $data['name']="";
      $data['url']='users';
      $data['page']='index';
      $data['allMenu']=$menus;
      $data['menu_id']="";
      if(!empty($page)){
        foreach ($menus as $key => $menu) {
          if($menu['url']=='users'){
              $data['menu_id']=$menu['menu_id'];
              $data['name']=$menu['name'];
          }
        }
      }
      $data['users']=$users;
        // $data=User::get()->toArray();
      return view($data['url'].".index")->with('data',$data);
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
      ]);
      $file=$request->file('photofile');
      $photofile="";
      if(!empty($file)){
        $photofile=$file->getClientOriginalName();
        $request->photofile->storeAs('images',$photofile,'public');
      }
      $user = User::create([
        'account' => $request->email,
        'role' => $request->role,
        'team' => $request->team,
        'modify_by' => Auth::user()->account,
        'modify_time' => date("Y-m-d H:i:s"),
        'tel' => $request->tel,
        'name' => $request->name,
        'email' => $request->email,
        'utma' => '',
        'password' => Hash::make($request->password),
        'photofile' => $photofile,
      ]);
      event(new Registered($user));
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
      $teams=Ad_team::get()->toArray();
      $roles=Ad_role::get()->toArray();
      $data['user']=$user;
      $data['teams']=$teams;
      $data['roles']=$roles;
      $menus=$this->menus;
      $data['name']="";
      $data['url']='users';
      $data['page']='show';
      $data['allMenu']=$menus;
      $data['menu_id']="";
      if(!empty($page)){
        foreach ($menus as $key => $menu) {
          if($menu['url']=='users'){
              $data['menu_id']=$menu['menu_id'];
              $data['name']=$menu['name'];
          }
        }
      }
        // $data=User::get()->toArray();
        return view($data['url'].".show")->with('data',$data);
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
      $teams=Ad_team::get()->toArray();
      $roles=Ad_role::get()->toArray();
      $data['user']=$user;
      $data['teams']=$teams;
      $data['roles']=$roles;
      $menus=$this->menus;
      $data['name']="";
      $data['url']='users';
      $data['page']='edit';
      $data['allMenu']=$menus;
      $data['menu_id']="";
      if(!empty($page)){
        foreach ($menus as $key => $menu) {
          if($menu['url']=='users'){
              $data['menu_id']=$menu['menu_id'];
              $data['name']=$menu['name'];
          }
        }
      }
        // $data=User::get()->toArray();
        return view($data['url'].".edit")->with('data',$data);
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
      $input = $request->except('_token', '_method');
      $data=User::find($id);
      $data->name=$input['name'];
      $data->email=$input['email'];
      $data->email=$input['email'];
      $data->tel=$input['tel'];
      $data->team=$input['team'];
      $data->role=$input['role'];
      $data->status=$input['status'];
      $data->modify_by=Auth::user()->account;
      $file=$request->file('photofile');
      if(!empty($file)){
        $data->photofile=$file->getClientOriginalName();
        $request->photofile->storeAs('images',$data->photofile,'public');
      }
      $data->save();
      return redirect()->route('users.show', ['user'=> $id ]);
      
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