<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;


class UserRepository
{
    private $user;

    public function __construct(User $user)
    {
        $this->user =$user;
    }

    public function getPageinate($pageinate)
    {
        $data = $this->user->paginate($pageinate)->toArray();
        return $data;
    }

    public function getByID($id)
    {
        $data=[];
        if(is_array($id)){
            if(!empty($id)){
                foreach ($id as $key => $value) {
                    $data[] = $this->user->where('id', $value)->first()->toArray();
                }
            }
        }else{
            $data = $this->user->where('id', $id)->first()->toArray();
        }

        return $data;
    }

    public function addOne($input, $file)
    {
        $data =new $this->user();
        $data->name = $input['name'];
        $data->email = $input['email'];
        $data->password = $input['password'];
        $data->tel = $input['tel'];
        $data->team = $input['team'];
        $data->role = $input['role'];
        $data->status = $input['status'];
        $data->modify_by = $input['modify_by'];
        if (!empty($file)) {
            $data->photofile = $input['photofile'];
            $file->storeAs('images', $data->photofile, 'public');
        }
        $data->save();
        return $data;
    }

    public function updateOne($input, $id, $file)
    {
        // $data = $this->user::find($id)->update($input);
        $data = $this->user::find($id);
        $data->name = $input['name'];
        $data->tel = $input['tel'];
        $data->team = $input['team'];
        $data->role = $input['role'];
        $data->status = $input['status'];
        $data->modify_by = $input['modify_by'];
        if (!empty($file)) {
            $data->photofile = $input['photofile'];
            $file->storeAs('images', $data->photofile, 'public');
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
            $users_id=[];
            foreach ($keyWordAry as $key => $value) {
                $data = $this->user
                ->where('name','like', '%'.$value.'%')
                ->orWhere('email','like', '%'.$value.'%')->get(['id']);
                foreach ($data as $key => $value) {
                    if(!in_array($value->id,$users_id)){
                        $users_id[]=$value->id;
                    }
                }
            }
            return $users_id;
        }else{
            return;
        }
    }

    public function delByID($user_id)
    {
        $this->user->where('id', $user_id)->delete();
    }
}
