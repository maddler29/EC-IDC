<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
        'description' => $faker->paragraph,
        'image' => $faker->image,
        'price' => $faker->numberBetween(100, 9999),
        'size' => $faker->word,
        'material' => $faker->word,
        'brand_category_id' => $faker->numberBetween(1, 10),
        'item_category_id' => $faker->numberBetween(1, 24),

    ];
});
