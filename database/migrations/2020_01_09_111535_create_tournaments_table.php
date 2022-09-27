<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('game_id');
            $table->integer('country_id');
            $table->integer('region_id'); 
            $table->tinyInteger('user_type');
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->date('reg_start_date');
            $table->date('reg_end_date');
            $table->time('reg_start_time');
            $table->time('reg_end_time');
            $table->integer('prize_money');
            $table->integer('prize_currency');
            $table->text('other_reward');
            $table->string('image');
            $table->integer('max_players');
            $table->integer('room_size');
            $table->longText('rules_description');
            $table->tinyInteger('is_free');
            $table->integer('part_amount');
            $table->integer('part_currency');
            $table->string('ps_number');
            $table->tinyInteger('status');
            $table->string('meta_title');
            $table->longText('meta_keyword');
            $table->text('meta_description');
            $table->integer('no_user_prize_dist');
            $table->text('slug');
            $table->tinyInteger('stop_joining');
            $table->tinyInteger('is_completed');
            $table->smallInteger('is_active')->default(1);
            $table->smallInteger('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournaments');
    }
}
