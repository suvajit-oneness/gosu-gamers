<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Game;

use Faker\Generator as Faker;

$factory->define(Game::class, function (Faker $faker) {
    return [
  		"name" => $faker->name,
        "description" => $faker->text,
        "image"=>$faker->imageUrl,
        "is_active" => 1,
        "is_deleted" => 0,

    ];
});
