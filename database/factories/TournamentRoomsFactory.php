<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tournament_rooms;
use App\Models\Tournaments;
use Faker\Generator as Faker;

$factory->define(Tournament_rooms::class, function (Faker $faker) {
    return [
        "tournament_id" => Tournaments::all()->random()->id,
        "game_room_id" =>$faker->randomDigit(),
        "room_code" => $faker->sentence,
        "status"=>$faker->randomDigit(),
        "is_active" => 1,
        "is_deleted" => 0,
    ];
});
