<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Country;
use Illuminate\Support\Str;
use App\Models\Region;
use Faker\Generator as Faker;

$factory->define(Country::class, function (Faker $faker) {
    return [
        "region_id" => Region::all()->random()->id,
        "name" => $faker->country,
        "iso3" => $faker->countryCode,
        "numcode" => $faker->randomDigit(1, 9),
        "phonecode" => $faker->randomDigit(1, 1000),
        "is_active" => 1,
        "is_deleted" => 0,
    ];
});
