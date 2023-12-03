<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class RecipesTableSeeder extends Seeder
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
                'display_title'=>'sample1',
                'title'=>'cake1',
                'memo'=>'cakesample1',
                'main_image'=>'1',
                'tag_id'=>'1',
                'time'=>'60',
                'serve'=>'2',
            ],
            [
                'display_title'=>'sample2',
                'title'=>'cake2',
                'memo'=>'cakesample2',
                'main_image'=>'1',
                'tag_id'=>'1',
                'time'=>'30',
                'serve'=>'1',
            ],
            [
                'display_title'=>'sample3',
                'title'=>'cookie',
                'memo'=>'cookiesample1',
                'main_image'=>'1',
                'tag_id'=>'2',
                'time'=>'10',
                'serve'=>'1',
            ],
        ];
        foreach($params as $param){
            DB::table('recipes')->insert($param);
        }
    }
}
