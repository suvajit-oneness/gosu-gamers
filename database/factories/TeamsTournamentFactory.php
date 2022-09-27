<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Teams_tournament;
use App\Models\Teams;
use App\Models\Tournaments;
use Faker\Generator as Faker;

$factory->define(Teams_tournament::class, function (Faker $faker) {
    return [
        
        "team_id" => Teams::all()->random()->id,
        "tournament_id" =>Tournaments::all()->random()->id,
		"room_code"=>$faker->sentence,
		"point"=>$faker->randomDigit(),
		"payment_status"=>$faker->randomDigit(),
		"score"=>$faker->randomDigit(),
		"earning"=>$faker->randomDigit(),
		"currency_id"=>$faker->randomDigit(),
		"status"=>$faker->randomDigit(),
        "is_active" => 1,
        "is_deleted" => 0,
    ];
});
