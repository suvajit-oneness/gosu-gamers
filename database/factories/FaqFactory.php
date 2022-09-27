<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Faq;
use Faker\Generator as Faker;

$factory->define(Faq::class, function (Faker $faker) {
    return [
        "question" => $faker->sentence,
        "answer" => $faker->text,
        "is_active" => 1,
        "is_deleted" => 0,
    ];
});
