<?php

namespace Database\Seeders;

use Illuminate\support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Products_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param =[
            'id' => 1,
            'name' =>'美味しいコーヒー',
            'price' =>650,
            'stock_flag' =>1,
            'stocks' =>15,
            'store_id' =>1,
        ];
        DB::table('products')-> insert($param);

        $param =[
            'id' => 2,
            'name' =>'ベイクドチーズケーキ',
            'price' =>600,
            'stock_flag' =>1,
            'stocks' =>10,
            'store_id' =>1,
        ];
        DB::table('products')-> insert($param);

        $param =[
            'id' => 3,
            'name' =>'ケーキセット',
            'price' =>1000,
            'stock_flag' =>1,
            'stocks' =>30,
            'store_id' =>1,
        ];
        DB::table('products')-> insert($param);


    }
}
