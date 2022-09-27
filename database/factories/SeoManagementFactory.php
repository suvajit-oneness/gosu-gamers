<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Seo_management;
use Faker\Generator as Faker;

$factory->define(Seo_management::class, function (Faker $faker) {
    return [
       	"page_name" => $faker->name,
        "slug" => $faker->slug,
        "meta_title" => $faker->sentence,
        "meta_keywords" => $faker->sentence,
        "meta_description" => $faker->text,
        "is_active" => 1,
        "is_deleted" => 0,
    ];
});
