<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Region;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Region::class, function (Faker $faker) {
    return [

        "name" => $faker->country,
        "continent_id" => $faker->randomDigit(1, 7),
        "is_active" => 1,
        "is_deleted" => 0,

    ];
});
