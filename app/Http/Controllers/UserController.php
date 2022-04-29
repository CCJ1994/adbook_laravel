<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ad_team;
use App\Models\Ad_role;
use Illuminate\Support\Facades\Storage;

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
      $menus=$this->menus;
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
      return view('dashboard')->with('data',$data);
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
        //
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
      return view('dashboard')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
