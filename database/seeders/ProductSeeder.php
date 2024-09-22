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
              'product_name' => 'コーラ_01',
              'price' => 120,
              'stock' => 1000,
              'comment' => 'おいしい',
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ],
            [ 'company_id' => 1,
              'product_name' => 'コーラ_02',
              'price' => 240,
              'stock' => 500,
              'comment' => 'かなりおいしい',
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
              'product_name' => 'オレンジジュース',
              'price' => 110,
              'stock' => 500,
              'comment' => 'あまい',
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ],
            [ 'company_id' => 2,
              'product_name' => 'ビール_01',
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
              'updated_at' => new DateTime() ],
            [ 'company_id' => 1,
              'product_name' => 'お茶_03',
              'price' => 100,
              'stock' => 2000,
              'comment' => '濃い',
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ],
            [ 'company_id' => 2,
              'product_name' => 'アップルジュース',
              'price' => 110,
              'stock' => 500,
              'comment' => 'あまい',
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ],
            [ 'company_id' => 2,
              'product_name' => 'ビール_02',
              'price' => 250,
              'stock' => 1500,
              'comment' => 'にがい',
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ],
            [ 'company_id' => 3,
              'product_name' => 'ブドウジュース',
              'price' => 150,
              'stock' => 500,
              'comment' => 'いい香り',
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ],
            [ 'company_id' => 1,
              'product_name' => 'アイスコーヒー',
              'price' => 100,
              'stock' => 2000,
              'comment' => '黒い',
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ],
            [ 'company_id' => 2,
              'product_name' => 'ホットコーヒー',
              'price' => 110,
              'stock' => 500,
              'comment' => 'あまい',
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ],
            [ 'company_id' => 2,
              'product_name' => '紅茶',
              'price' => 250,
              'stock' => 1500,
              'comment' => 'ストレート',
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ],
            [ 'company_id' => 3,
              'product_name' => 'レモンティー',
              'price' => 150,
              'stock' => 500,
              'comment' => 'いい香り',
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ]
        ]);
    }
}
