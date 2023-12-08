<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class faqsTableSeeder extends Seeder
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
                'answer'=>'',
                'question'=>'',
            ],
            [
                'answer'=>'',
                'question'=>'',
            ],
            [
                'answer'=>'',
                'question'=>'',
            ],
            [
                'answer'=>'',
                'question'=>'',
            ],
            [
                'answer'=>'',
                'question'=>'',
            ],
        ];
        foreach($params as $param){
            DB::table('faqs')->insert($param);
        }
    }
}
