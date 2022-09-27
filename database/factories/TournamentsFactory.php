<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tournaments;
use App\Models\Game;
use App\Models\Region;
use App\Models\Country;
use Faker\Generator as Faker;

$factory->define(Tournaments::class, function (Faker $faker) {
    return [
        "name" => $faker->name,
        "game_id" => Game::all()->random()->id,
        "country_id" =>Country::all()->random()->id,
        "region_id"=>Region::all()->random()->id,
        "user_type" => $faker->randomDigit(),
        "start_date"=>$faker->date($format = 'Y-m-d', $max = 'now'),
        "end_date"=>$faker->date($format = 'Y-m-d', $max = 'now'),
        "start_time"=>$faker->time($format = 'H:i:s', $max = 'now'),
        "end_time"=>$faker->time($format = 'H:i:s', $max = 'now'),
        "description"=>$faker->text,
        "reg_start_date"=>$faker->date($format = 'Y-m-d', $max = 'now'),
        "reg_end_date"=>$faker->date($format = 'Y-m-d', $max = 'now'),
        "reg_start_time"=>$faker->time($format = 'H:i:s', $max = 'now'),
        "reg_end_time" => $faker->time($format = 'H:i:s', $max = 'now'),
        "prize_money" => $faker->randomDigit(),
        "prize_currency"=>$faker->currencyCode,
        "other_reward"=>$faker->text,
        "image" =>$faker->imageUrl, 
        "max_players"=>$faker->randomDigit(),
        "room_size"=>$faker->randomDigit(),
        "rules_description"=>$faker->text,
        "is_free"=>$faker->randomDigit(),
        "part_amount"=>$faker->randomDigit(),
        "part_currency"=>$faker->currencyCode,
        "ps_number" =>$faker->name,
        "status"=>$faker->randomDigit(),
        "meta_title" => $faker->sentence,
        "meta_keyword"=>$faker->text,
        "meta_description"=>$faker->text,
        "no_user_prize_dist"=>$faker->randomDigit(),
        "slug"=>$faker->text,
        "stop_joining"=>$faker->randomDigit(),
        "is_completed"=>$faker->randomDigit(),
        "is_active" => 1,
        "is_deleted" => 0,
    ];
});
