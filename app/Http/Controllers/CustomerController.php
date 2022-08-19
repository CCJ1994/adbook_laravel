<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\CustomerRepository;

use App\Services\ArrayService;

class CustomerController extends Controller
{
    private $customerRepository;

    public function __construct(
        CustomerRepository $customerRepository
    ) {
        $this->customerRepository=$customerRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=[];
        $customer=$this->customerRepository->getPageinate(15);
        $data['customers']=$customer;
        $data['title']="客戶基本資料";
        $data['url']="customers";
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
        return $request;
        $request->validate([
            'name'=>['required', 'string', 'max:20'],
            'contact'=>['nullable', 'string', 'max:20'],
            'email'=>['nullable', 'string','email', 'max:255'],
            'phone'=>['nullable','regex:/^([0-9\s\-\+\(\)]*)$/','min:8','max:10'],
            'fax'=>['nullable','regex:/^([0-9\s\-\+\(\)]*)$/','min:10','max:10'],
            'addr'=>['nullable', 'string', 'max:50'],
            'type'=>['required','integer'],
            'customer'=>['nullable', 'string', 'max:20'],
            'ein'=>['required','regex:/^([0-9\s\-\+\(\)]*)$/','min:7','max:8'],
            'udn'=>['required', 'string'],
            'memo'=>['nullable', 'string'],
            'class'=>['required','integer'],
            'status'=>['required','integer'],
        ]);
        $input = $request->except('_token');
        $input['modify_by'] =  Auth::user()->email;
        $data =$this->customerRepository->addOne($input);
        return $data;
        // return redirect()->route('customers.index');
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
        $customer=$this->customerRepository->getByID($id);
        $data['customer']=$customer;
        $data['title']="客戶基本資料";
        $data['url']="customers";
        $data['page']='show';
        return $data;

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
        $customer=$this->customerRepository->getByID($id);
        $data['customer']=$customer;
        $data['title']="客戶基本資料";
        $data['url']="customers";
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
        $data=$this->customerRepository->updateOne($input, $id);

        return redirect()->route('customers.show', ['Customer'=> $id]);
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
        $customer=$this->customerRepository->showAll(10);
        $data['customer']=$customer;
        $data['title']='公告';
        $data['url']='home';
        $data['page']='index';

        return view($data['url'].".".$data['page'])->with('data', $data);
    }

    public function showOff(Request $request, $id)
    {
        $input = $request->except('_token', '_method');
        $input['modify_by']= Auth::user()->email;
        $data=$this->customerRepository->updateByField($input, $id);

        return redirect()->route('customers.index');
    }
}
