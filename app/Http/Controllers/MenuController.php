<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Ad_menu;
use App\Models\Ad_bb;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=[];
        $bboard=Ad_bb::get()->toArray();
        $menus=$this->menus;
        $data['bboard']=$bboard;
        $data['url']='home';
        $data['name']='公告';
        $data['allMenu']=$menus;
        $data['menu_id']='0';
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
       //
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

    public function getMenu($page)
    {
      $data=[];
      $menus=$this->menus;
      $data['name']="";
      $data['url']=$page;
      $data['allMenu']=$menus;
      $data['menu_id']="";
      if(!empty($page)){
        foreach ($menus as $key => $menu) {
          if($menu['url']==$page){
              $data['menu_id']=$menu['menu_id'];
              $data['name']=$menu['name'];
          }
        }
      }else{
        $data['url']='dashboard';
    }
    return view('dashboard')->with('data',$data);
    }
}
