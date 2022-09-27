<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Gamer_tournament_point;
use App\Models\Gamer_tournament_schedule;
use Faker\Generator as Faker;

$factory->define(Gamer_tournament_point::class, function (Faker $faker) {
    return [
        "schedule_id" => Gamer_tournament_schedule::all()->random()->id,
        "player1_score" =>$faker->randomDigit(),
        "player2_score" =>$faker->randomDigit(),
        "player1_point" =>$faker->randomDigit(),
        "player2_point" =>$faker->randomDigit(),
        "winner"=>$faker->randomDigit(),
		"is_active" => 1,
        "is_deleted" => 0,
  
    ];
});
