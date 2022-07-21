<?php

namespace Database\Seeders;

use Illuminate\support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Stores_seeder extends Seeder
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
            'name' =>'Demo cafe 東区役所前店',
            'address' =>'札幌市東区北***条***丁目',
          ];
        DB::table('stores')-> insert($param);
    }
}
