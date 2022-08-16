<?php
namespace App\Services;

// use App\Repositories\BboardRepository;

class ArrayService
{

    // public $BboardRepository;

    // public function __construct()
    // {
    //     $this->BboardRepository = new BboardRepository;
    // }

    public function shortString($data,$keyName){
        foreach ($data as $key => $value) {
            if (mb_strlen($value[$keyName]) > 20) {
                $data[$key][$keyName]=mb_substr($value[$keyName], 0, 20)." ...";
            }
        }
        return $data;
    }


}
