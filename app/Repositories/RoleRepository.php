<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Support\Collection;

class RoleRepository
{
    private $role;

    public function __construct(Role $role)
    {
        $this->role =$role;
    }

    public function getAll()
    {
        $data = $this->role->get()->toArray();
        return $data;
    }
    public function getPluck($key,$value)
    {
        $data = $this->role->get()->collect()->pluck($value, $key)->all();
        return $data;
    }

    public function getByID($id)
    {
        $data = $this->role->where('id', $id)->first()->toArray();

        return $data;
    }

    public function delByID($role_id)
    {
        $this->role->where('id', $role_id)->delete();
    }
}
