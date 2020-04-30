<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Ingredient;
use App\Models\Recipe;
use Faker\Generator as Faker;

$factory->define(Ingredient::class, function (Faker $faker) {
    return [
        'recipe_id' => factory(Recipe::class)->create()->id,
        'quantity' => 1,
        'name' => $faker->name,
        'description' => $faker->sentence(8)
    ];
});
