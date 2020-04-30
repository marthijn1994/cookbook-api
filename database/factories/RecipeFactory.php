<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Recipe;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Recipe::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'category_id' => factory(Category::class)->create()->id,
        'uuid' => Str::uuid(),
        'title' => $faker->title,
        'description' => $faker->sentence(8),
        'calories' => 500.50,
        'persons' => 3,
        'time' => '60min'
    ];
});
