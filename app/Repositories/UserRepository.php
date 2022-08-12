<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class UserRepository
{
    private $user;

    public function __construct(User $user)
    {
        $this->user =$user;
    }

    public function getAll($pageinate)
    {
        $data = $this->user->paginate($pageinate);
        return $data;
    }

    public function getByID($id)
    {
        $data = $this->user->where('id', $id)->first();

        return $data;
    }

    public function addOne($input, $file)
    {
        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'tel' => ['nullable','numeric','between:8,10'],
            'photofile' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.index')->withErrors($validator);
        } else {
            $data =new $this->user();
            $data->name = $input['name'];
            $data->email = $input['email'];
            $data->password = $input['password'];
            $data->password_confirmation = $input['password_confirmation'];
            $data->tel = $input['tel'];
            $data->team = $input['team'];
            $data->role = $input['role'];
            $data->modify_by = Auth::user()->email;
            $data->modify_time = date("Y-m-d H:i:s");
            if (!empty($file)) {
                $data->photo = $input['photofile'];
                $data->photofile = Storage::putFile('', new File($file));
            }
            $data->password = Hash::make($data->password);
            if (!empty($file)) {
                $file->storeAs('images', $data->photofile, 'public');
            }
            $data->save();
        }
        return $data;
    }

    public function updateOne($input, $id, $file)
    {
        $data = $this->user::find($id);
        $data->name = $input['name'];
        $data->chinese = $input['chinese'];
        $data->english = $input['english'];
        $data->math = $input['math'];
        if (!empty($file)) {
            $data->photo = $file->getClientOriginalName();
            $file->storeAs('images', $data->photo, 'public');
        }
        $data->save();
        return $data;
    }

    public function delByID($user_id)
    {
        $this->user->where('id', $user_id)->delete();
    }
}
