<?php

use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gender_categories')->insert([
            [
                'id'     => 1,
                'gender' => 'male',
                'sort_no' => 1,
            ],
            [
                'id'     => 2,
                'gender' => 'female',
                'sort_no' => 2,
            ],

        ]);
    }
}
