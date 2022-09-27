<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Team_tournament_point;
use App\Models\Team_tournament_schedule;
use Faker\Generator as Faker;

$factory->define(Team_tournament_point::class, function (Faker $faker) {
    return [
        "team_schedule_id" => Team_tournament_schedule::all()->random()->id,
        "team1_score" =>$faker->randomDigit(),
        "team2_score" =>$faker->randomDigit(),
        "team1_point" =>$faker->randomDigit(),
        "team2_point" =>$faker->randomDigit(),
        "winner"=>$faker->randomDigit(),
		"is_active" => 1,
        "is_deleted" => 0,
    ];
});
