<?php

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_categories')->insert([
            [
                'id'                  => 1,
                'item_name'           => 'パンツ',
                'sort_no'             => 1,
                'gender_id'           => 1,
            ],
            [
                'id'                  => 2,
                'item_name'           => 'パンツ',
                'sort_no'             => 2,
                'gender_id'           => 2,
            ],
            [
                'id'                  => 3,
                'item_name'           => 'シャツ・ブラウス',
                'sort_no'             => 3,
                'gender_id'           => 1,
            ],
            [
                'id'                  => 4,
                'item_name'           => 'シャツ・ブラウス',
                'sort_no'             => 4,
                'gender_id'           => 2,
            ],
            [
                'id'                  => 5,
                'item_name'           => 'ジャケット・コート',
                'sort_no'             => 5,
                'gender_id'           => 1,

            ],
            [
                'id'                  => 6,
                'item_name'           => 'ジャケット・コート',
                'sort_no'             => 6,
                'gender_id'           => 2,

            ],
            [
                'id'                  => 7,
                'item_name'           => 'ショートパンツ',
                'sort_no'             => 7,
                'gender_id'           => 1,

            ],
            [
                'id'                  => 8,
                'item_name'           => 'ショートパンツ',
                'sort_no'             => 8,
                'gender_id'           => 2,

            ],
            [
                'id'                  => 9,
                'item_name'           => 'キュロット',
                'sort_no'             => 9,
                'gender_id'           => 1,

            ],
            [
                'id'                  => 10,
                'item_name'           => 'キュロット',
                'sort_no'             => 10,
                'gender_id'           => 2,

            ],
            [
                'id'                  => 11,
                'item_name'           => 'スカートAライン',
                'sort_no'             => 11,
                'gender_id'           => 1,
            ],
            [
                'id'                  => 12,
                'item_name'           => 'スカートAライン',
                'sort_no'             => 12,
                'gender_id'           => 2,
            ],
            [
                'id'                  => 13,
                'item_name'           => 'ロングスカート',
                'sort_no'             => 13,
                'gender_id'           => 1,

            ],
            [
                'id'                  => 14,
                'item_name'           => 'ロングスカート',
                'sort_no'             => 14,
                'gender_id'           => 2,

            ],
            [
                'id'                  => 15,
                'item_name'           => 'タイトスカート',
                'sort_no'             => 15,
                'gender_id'           => 1,
            ],
            [
                'id'                  => 16,
                'item_name'           => 'タイトスカート',
                'sort_no'             => 16,
                'gender_id'           => 2,
            ],
            [
                'id'                  => 17,
                'item_name'           => 'ラップスカート',
                'sort_no'             => 17,
                'gender_id'           => 1,

            ],
            [
                'id'                  => 18,
                'item_name'           => 'ラップスカート',
                'sort_no'             => 18,
                'gender_id'           => 2,

            ],
            [
                'id'                  => 19,
                'item_name'           => 'パジャマ',
                'sort_no'             => 19,
                'gender_id'           => 1,
            ],
            [
                'id'                  => 20,
                'item_name'           => 'パジャマ',
                'sort_no'             => 20,
                'gender_id'           => 2,
            ],
            [
                'id'                  => 21,
                'item_name'           => 'ニット',
                'sort_no'             => 21,
                'gender_id'           => 1,
            ],
            [
                'id'                  => 22,
                'item_name'           => 'ニット',
                'sort_no'             => 22,
                'gender_id'           => 2,
            ],
            [
                'id'                  => 23,
                'item_name'           => 'ワンピース',
                'sort_no'             => 23,
                'gender_id'           => 1,

            ],
            [
                'id'                  => 24,
                'item_name'           => 'ワンピース',
                'sort_no'             => 24,
                'gender_id'           => 2,

            ],

        ]);
    }
}
