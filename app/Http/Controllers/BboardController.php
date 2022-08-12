<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bboard;
use Illuminate\Support\Facades\Auth;

class BboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=[];
        $bboard=Bboard::where('status','<>', 0)
                    ->orderBy('msg_date', 'DESC')->paginate(15)->toArray();

        foreach ($bboard['data'] as $key => $value) {
            if(mb_strlen($value['content']) > 20){
                $bboard['data'][$key]['content']=mb_substr($value['content'],0,20)." ...";
            }
        }
        $data['bboard']=$bboard;
        $data['title']="公告內容";
        $data['url']="bboards";
        $data['page']='index';
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
            'topic' => ['required', 'string', 'max:20'],
            'msg_date' => ['required', 'date'],
            'content' => ['required', 'string', '', 'max:60000'],
            'status' => ['required'],
        ]);
        $Bboard=Bboard::create([
            'topic' => $request->topic,
            'msg_date' => $request->msg_date,
            'content' => $request->content,
            'status' => $request->status,
            'updated_at' => date("Y-m-d H:i:s"),
            'modify_by' => Auth::user()->email,
        ]);
        return redirect()->route('bboards.index');
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
        $bboard=Bboard::find($id)->toArray();
        $data['bboard']=$bboard;
        $data['title']="公告內容";
        $data['url']="bboards";
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
        $bboard=Bboard::find($id)->toArray();
        $data['bboard']=$bboard;
        $data['title']="公告內容";
        $data['url']="bboards";
        $data['page']='show';
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
            'topic' => ['required', 'string', 'max:20'],
            'msg_date' => ['required', 'date'],
            'content' => ['required', 'string', '', 'max:60000'],
            'status' => ['required'],
        ]);
        $input = $request->except('_token', '_method');
        $data=Bboard::find($id);
        $data->topic=$input['topic'];
        $data->msg_date=$input['msg_date'];
        $data->content=$input['content'];
        $data->status=$input['status'];
        $data->modify_by=Auth::user()->email;
        $data->updated_at=date("Y-m-d H:i:s");
        $data->save();
        return redirect()->route('bboards.show', ['Bboard'=> $id]);

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
    public function home()
    {
        $data=[];
        $bboard=Bboard::where('status', 1)
                        ->where('msg_date','<=',date('Y-m-d'))
                        ->orderBy('msg_date', 'DESC')->paginate(10)->toArray();
        $data['bboard']=$bboard;
        $data['title']='公告';
        $data['url']='home';
        $data['page']='index';
        return view($data['url'].".index")->with('data',$data);
    }

    public function showOff(Request $request,$id)
    {

        $input = $request->except('_token', '_method');
        $data=Bboard::find($id);
        $data->status = $input['status'];
        $data->save();
        return redirect()->route('bboards.index');
    }

}
