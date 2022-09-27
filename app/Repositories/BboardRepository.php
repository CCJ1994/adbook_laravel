<?php

namespace App\Repositories;

use App\Models\Bboard;

class BboardRepository
{
    private $bboard;

    public function __construct(Bboard $bboard)
    {
        $this->bboard =$bboard;
    }

    public function showAll($pageinate)
    {
        $data = $this->bboard->where('status', 1)
                    ->where('msg_date', '<=', date('Y-m-d'))
                    ->orderBy('msg_date', 'DESC')
                    ->paginate($pageinate)->toArray();
        return $data;
    }
    public function getPageinate($pageinate)
    {
        $data = $this->bboard->where('status', '<>', 0)->orderBy('msg_date', 'DESC')->paginate($pageinate)->toArray();
        return $data;
    }

    public function getByID($id)
    {
        $data=[];
        if(is_array($id)){
            if(!empty($id)){
                foreach ($id as $key => $value) {
                    $data[] = $this->bboard->where('id', $id)->first()->toArray();
                }
            }
        }else{
            $data = $this->bboard->where('id', $id)->first()->toArray();
        }
        return $data;
    }

    public function addOne($input)
    {
        $data = new $this->bboard();
        $data->topic = $input['topic'];
        $data->msg_date = $input['msg_date'];
        $data->content = $input['content'];
        $data->status = $input['status'];
        $data->modify_by = $input['modify_by'];
        $data->save();
        return $data;
    }

    public function updateOne($input, $id)
    {
        $data = $this->bboard::find($id);
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
        $data = $this->bboard::find($id);
        foreach ($input as $key => $value) {
            $data->$key = $value;
        }
        $data->save();
        return $data;
    }
    public function keyWord($input)
    {
        $keyWordAry=[];
        $resultAry=[];
        if(!empty($input->keyWord)){
            $keyWordAry = array_filter(explode(" ",$input->keyWord));
            $bboard_id=[];
            foreach ($keyWordAry as $key => $value) {
                $data = $this->bboard
                ->where('topic','like', '%'.$value.'%')
                ->orWhere('content','like', '%'.$value.'%')
                ->orWhere('msg_date','like', '%'.$value.'%')->get(['id']);
                foreach ($data as $key => $value) {
                    if(!in_array($value->id,$bboard_id)){
                        $bboard_id[]=$value->id;
                    }
                }
            }
            return $bboard_id;
        }else{
            return;
        }
    }
    public function delByID($bboard_id)
    {
        $this->bboard->where('id', $bboard_id)->delete();
    }
}
