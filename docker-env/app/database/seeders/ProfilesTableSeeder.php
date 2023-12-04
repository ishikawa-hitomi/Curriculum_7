<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params=[
            [
                'user_id'=>'1',
                'icon'=>'',
                'profile'=>'sample1',
            ],
            [
                'user_id'=>'2',
                'icon'=>'',
                'profile'=>'sample2',
            ],
        ];
        foreach($params as $param){
            DB::table('profiles')->insert($param);
        }
    }
}
