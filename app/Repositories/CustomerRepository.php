<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer =$customer;
    }

    public function getPageinate($pageinate)
    {
        $data = $this->customer
                    ->where('status', 1)
                    ->orderBy('name', 'ASC')
                    ->paginate($pageinate)->toArray();
        return $data;
    }

    public function getByID($id)
    {
        $data = $this->customer->where('id', $id)->first()->toArray();

        return $data;
    }

    public function addOne($input)
    {
        $data = new $this->customer();
        $data->name = $input['name'];
        $data->contact = $input['contact'];
        $data->email = $input['email'];
        $data->phone = $input['phone'];
        $data->fax = $input['fax'];
        $data->addr = $input['addr'];
        $data->type = $input['type'];
        $data->customer = $input['customer'];
        $data->ein = $input['ein'];
        $data->udn = $input['udn'];
        $data->memo = $input['memo'];
        $data->class = $input['class'];
        $data->status = $input['status'];
        $data->modify_by = $input['modify_by'];

        $data->save();
        return $data;
    }

    public function updateOne($input, $id)
    {
        $data = $this->customer::find($id);
        $data->topic = $input['topic'];
        $data->msg_date = $input['msg_date'];
        $data->content = $input['content'];
        $data->status = $input['status'];
        $data->modify_by = $input['modify_by'];
        $data->save();
        return $data;
    }
    public function updateByField($input, $id)
    {
        $data = $this->customer::find($id);
        foreach ($input as $key => $value) {
            $data->$key = $value;
        }
        $data->save();
        return $data;
    }
    public function delByID($customer_id)
    {
        $this->customer->where('id', $customer_id)->delete();
    }
}
