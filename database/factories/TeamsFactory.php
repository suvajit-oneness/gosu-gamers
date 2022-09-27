<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Teams;
use App\Models\Subscription_type;
use App\Models\Country;
use Faker\Generator as Faker;

$factory->define(Teams::class, function (Faker $faker) {
    return [
        "team_name" => $faker->name,
        "subscription_type" =>Subscription_type::all()->random()->id,
         "fname" => $faker->name,
        "lname" => $faker->lastName,
        "country_id" =>Country::all()->random()->id,
        "email" => $faker->safeEmail,
        "password"=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        "otp"=>$faker->numberBetween($min = 1000, $max = 9000),
        "is_verified"=>1,
        "is_active" => 1,
        "is_deleted" => 0,
    ];
});
