<?php

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brand_categories')->insert([
            [
                'id'                  => 1,
                'brand_name'          => 'グレイスミス',
                'sort_no'             => 1,
                'gender_id'           => 1,

            ],
            [
                'id'                  => 2,
                'brand_name'          => 'グレイスミス',
                'sort_no'             => 2,
                'gender_id'           => 2,

            ],
            [
                'id'                  => 3,
                'brand_name'          => 'グレイS',
                'sort_no'             => 3,
                'gender_id'           => 1,

            ],
            [
                'id'                  => 4,
                'brand_name'          => 'グレイS',
                'sort_no'             => 4,
                'gender_id'           => 2,

            ],
            [
                'id'                  => 5,
                'brand_name'          => 'キール',
                'sort_no'             => 5,
                'gender_id'           => 1,
            ],
            [
                'id'                  => 6,
                'brand_name'          => 'キール',
                'sort_no'             => 6,
                'gender_id'           => 2,
            ],
            [
                'id'                  => 7,
                'brand_name'          => 'クリッパーシップ',
                'sort_no'             => 7,
                'gender_id'           => 1,

            ],
            [
                'id'                  => 8,
                'brand_name'          => 'クリッパーシップ',
                'sort_no'             => 8,
                'gender_id'           => 2,

            ],
            [
                'id'                  => 9,
                'brand_name'          => 'キャビア',
                'sort_no'             => 9,
                'gender_id'           => 1,

            ],
            [
                'id'                  => 10,
                'brand_name'          => 'キャビア',
                'sort_no'             => 10,
                'gender_id'           => 2,

            ],
            [
                'id'                  => 11,
                'brand_name'          => 'グレイS',
                'sort_no'             => 11,
                'gender_id'           => 1,

            ],
            [
                'id'                  => 12,
                'brand_name'          => 'グレイS',
                'sort_no'             => 12,
                'gender_id'           => 2,

            ],

        ]);
    }
}
