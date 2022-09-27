<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Gamer;
use App\Models\Country;
use Faker\Generator as Faker;

$factory->define(Gamer::class, function (Faker $faker) {
    return [
        "fname" => $faker->name,
        "lname" => $faker->lastName,
        "country_id" =>Country::all()->random()->id,
        "email" => $faker->safeEmail,
        "password"=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        "mobile"=>$faker->randomNumber,
        "image"=>$faker->imageUrl,
        "gender"=>$faker->randomLetter('M','F'),
        "description"=>$faker->text,
        "ref_code"=>$faker->postcode,
        "otp"=>$faker->postcode,
        "is_verified"=>1,
        "is_active" => 1,
        "is_deleted" => 0,
    ];
});
