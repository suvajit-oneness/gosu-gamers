<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Play_station;
use Faker\Generator as Faker;

$factory->define(Play_station::class, function (Faker $faker) {
    return [
  		"name" => $faker->name,
        "description" => $faker->text,
        "is_active" => 1,
        "is_deleted" => 0,
    ];
});
