<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\News;
use App\Models\News_category;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    return [
       "category_id" => News_category::all()->random()->id,
        "title" => $faker->sentence,
        "content" => $faker->text,
        "image" => $faker->imageUrl,
        "post_date" => $faker->date($format = 'Y-m-d', $max = 'now'),
        "uploaded_by" => $faker->name,
        "is_active" => 1,
        "is_deleted" => 0,
    ];
});
