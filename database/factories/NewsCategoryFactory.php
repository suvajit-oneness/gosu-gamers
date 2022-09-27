<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\News_category;
use Faker\Generator as Faker;

$factory->define(News_category::class, function (Faker $faker) {
    return [
  		"name" => $faker->name,
        "image"=>$faker->imageUrl,
        "is_active" => 1,
        "is_deleted" => 0,
    ];
});
