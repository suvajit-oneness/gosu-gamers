<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Gamer_tournament_schedule;
use App\Models\Tournaments;
use Faker\Generator as Faker;

$factory->define(Gamer_tournament_schedule::class, function (Faker $faker) {
    return [
        "tournament_id" => Tournaments::all()->random()->id,
        "player1" =>$faker->randomDigit(),
        "player2" =>$faker->randomDigit(),
        "start_time"=>$faker->time($format = 'H:i:s', $max = 'now'),
        "end_time"=>$faker->time($format = 'H:i:s', $max = 'now'),
        "stage" => $faker->sentence,
        "room_code" => $faker->sentence,
        "winner"=>$faker->randomDigit(),
        "runner"=>$faker->randomDigit(),
        "winner_point"=>$faker->randomDigit(),
        "runner_point"=>$faker->randomDigit(),
		"is_active" => 1,
        "is_deleted" => 0
          ];
    
});
