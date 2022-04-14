<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad_menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus=Ad_menu::get()->toArray();
        $menuAry['url']='home';
        $menuAry['name']='首頁';
        $menuAry['allMenu']=$menus;
        $menuAry['idad_menu']='1';
        return view('dashboard')->with('menus',$menuAry);
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
    public function show($page)
    {
        // $data=Ad_menu::get()->toArray();
        // $menuAry['mainMenu']=$data;
        // $menuAry['subMenu']=[];
        // $menu_id="";
        // foreach ($data as $key => $menu) {
        //     if($menu['url']==$page){
        //         $menu_id=$menu['menu_id'];
        //     }
        //     if($menu['idad_menu']==$menu_id){
        //         array_push($menuAry,$menu);
        //     }
        //     if($menu['menu_id']==$menu_id){
        //         array_push($menuAry,$menu);
        //     }
        // }
        // return view('page.'.$page)->with('menus',$menuAry);
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
      $menus=Ad_menu::get()->toArray();
      $menuAry['name']="";
      $menuAry['url']=$page;
      $menuAry['allMenu']=$menus;
      $menuAry['idad_menu']="";
      if(!empty($page)){
        foreach ($menus as $key => $menu) {
          if($menu['url']==$page){
              $menuAry['idad_menu']=$menu['menu_id'];
              $menuAry['name']=$menu['name'];
          }
        }
      }else{
        $menuAry['url']='dashboard';
    }
    return view('dashboard')->with('menus',$menuAry);
    }
}
