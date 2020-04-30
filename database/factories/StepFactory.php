<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Recipe;
use App\Models\Step;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Step::class, function (Faker $faker) {
    return [
        'recipe_id' => factory(Recipe::class)->create()->id,
        'uuid' => Str::uuid(),
        'order' => 1,
        'title' => $faker->title,
        'body' => $faker->sentence(65)
    ];
});
