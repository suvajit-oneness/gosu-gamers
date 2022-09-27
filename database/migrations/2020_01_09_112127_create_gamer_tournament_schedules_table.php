<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamerTournamentSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gamer_tournament_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('player1');
            $table->integer('player2');
            $table->integer('tournament_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('stage');
            $table->string('room_code');
            $table->integer('winner');
            $table->integer('runner');
            $table->integer('winner_point');
            $table->integer('runner_point');
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
        Schema::dropIfExists('gamer_tournament_schedules');
    }
}
