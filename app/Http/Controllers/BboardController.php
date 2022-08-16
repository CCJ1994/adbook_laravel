<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\BboardRepository;

use App\Services\ArrayService;

class BboardController extends Controller
{
    private $bboardRepository;

    public function __construct(
        BboardRepository $bboardRepository
    ) {
        $this->bboardRepository=$bboardRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=[];
        $bboard=$this->bboardRepository->getPageinate(15);

        $arrayService = new ArrayService();
        $bboard['data'] = $arrayService->shortString($bboard['data'],'content');
        $data['bboard']=$bboard;
        $data['title']="公告內容";
        $data['url']="bboards";
        $data['page']='index';
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
            'topic' => ['required', 'string', 'max:20'],
            'msg_date' => ['required', 'date'],
            'content' => ['required', 'string', '', 'max:60000'],
            'status' => ['required'],
        ]);
        $input = $request->except('_token');
        $input['modify_by'] =  Auth::user()->email;
        $data =$this->bboardRepository->addOne($input);

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
        $bboard=$this->bboardRepository->getByID($id);
        $data['bboard']=$bboard;
        $data['title']="公告內容";
        $data['url']="bboards";
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
        $bboard=$this->bboardRepository->getByID($id);
        $data['bboard']=$bboard;
        $data['title']="公告內容";
        $data['url']="bboards";
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
            'topic' => ['required', 'string', 'max:20'],
            'msg_date' => ['required', 'date'],
            'content' => ['required', 'string', '', 'max:60000'],
            'status' => ['required'],
        ]);
        $input = $request->except('_token', '_method');
        $input['modify_by']= Auth::user()->email;
        $data=$this->bboardRepository->updateOne($input, $id);

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
        $bboard=$this->bboardRepository->showAll(10);
        $data['bboard']=$bboard;
        $data['title']='公告';
        $data['url']='home';
        $data['page']='index';

        return view($data['url'].".".$data['page'])->with('data', $data);
    }

    public function showOff(Request $request, $id)
    {
        $input = $request->except('_token', '_method');
        $input['modify_by']= Auth::user()->email;
        $data=$this->bboardRepository->updateByField($input, $id );

        return redirect()->route('bboards.index');
    }
}
