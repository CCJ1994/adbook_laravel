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
        $data=Ad_menu::get()->toArray();
        // dd($data);
        return view('dashboard')->with('menus',$data);
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
        $data=Ad_menu::get()->toArray();
        $menuAry['mainMenu']=$data;
        $menuAry['subMenu']=[];
        $menu_id="";
        foreach ($data as $key => $menu) {
            if($menu['url']==$page){
                $menu_id=$menu['menu_id'];
            }
            if($menu['idad_menu']==$menu_id){
                array_push($menuAry,$menu);
            }
            if($menu['menu_id']==$menu_id){
                array_push($menuAry,$menu);
            }
        }
        return view('page.'.$page)->with('menus',$menuAry);
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
