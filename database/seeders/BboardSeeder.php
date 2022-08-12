<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class BboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now=now()->format('Y-m-d H:i:s');
        $amount=40;
        for ($i=0; $i < $amount; $i++) {
            $rand="";
            $rand=rand(01,$amount);
            DB::table('bboards')->insert([
                [ 'topic' => '主題-'.$rand,
                  'content'=>'內容-'.$rand.'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum nisi deserunt unde ipsam dolorem aut amet quae possimus adipisci, temporibus aperiam placeat ab sunt incidunt, sint eum. Odit, dolores officiis!',
                  'modify_by' => 'test@udn.com',
                  'msg_date' => date('Y-08-'.rand(01,12)),
                  'updated_at' => $now,
                  'created_at'=>$now ]
            ]);
        }
    }
}
