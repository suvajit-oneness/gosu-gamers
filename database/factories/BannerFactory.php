<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Banner;
use Faker\Generator as Faker;

$factory->define(Banner::class, function (Faker $faker) {
    return [
        "image" =>  $faker->imageUrl,
        "description" => $faker->text,
        "title" => $faker->sentence,
        "is_active" => 1,
        "is_deleted" => 0,
    ];
});
