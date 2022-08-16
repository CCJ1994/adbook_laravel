<?php

namespace App\Repositories;

use App\Models\Team;
use Illuminate\Support\Collection;

class TeamRepository
{
    private $team;

    public function __construct(Team $team)
    {
        $this->team =$team;
    }

    public function getAll()
    {
        $data = $this->team->get()->toArray();
        return $data;
    }
    public function getPluck($key,$value)
    {
        $data = $this->team->get()->collect()->pluck($value, $key)->all();
        return $data;
    }

    public function getByID($id)
    {
        $data = $this->team->where('id', $id)->first()->toArray();

        return $data;
    }

    public function delByID($team_id)
    {
        $this->team->where('id', $team_id)->delete();
    }
}
