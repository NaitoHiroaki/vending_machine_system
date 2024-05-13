<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [ 'company_id' => 1,
              'product_name' => 'コーラ',
              'price' => 120,
              'stock' => 1000,
              'comment' => 'おいしい',
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ],
            [ 'company_id' => 2,
              'product_name' => 'ジンジャエール',
              'price' => 130,
              'stock' => 1000,
              'comment' => 'からい',
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ],
            [ 'company_id' => 3,
              'product_name' => 'お茶_01',
              'price' => 100,
              'stock' => 2000,
              'comment' => 'しぶい',
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ],
              [ 'company_id' => 1,
              'product_name' => '100%果汁ジュース',
              'price' => 110,
              'stock' => 500,
              'comment' => 'あまい',
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ],
            [ 'company_id' => 2,
              'product_name' => 'ビール',
              'price' => 250,
              'stock' => 1500,
              'comment' => 'にがい',
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ],
            [ 'company_id' => 3,
              'product_name' => 'お茶_02',
              'price' => 150,
              'stock' => 500,
              'comment' => 'ふかい',
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ]
        ]);
    }
}
