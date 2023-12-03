<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
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
                "name"=>"cake",
            ],
            [
                "name"=>"cookie",
            ],
            [
                "name"=>"tart",
            ],
        ];
        foreach($params as $param){
            DB::table('tags')->insert($param);
        }
    }
}
