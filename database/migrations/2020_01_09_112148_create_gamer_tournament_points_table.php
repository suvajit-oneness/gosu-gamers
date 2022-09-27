<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamerTournamentPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gamer_tournament_points', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('schedule_id');
                $table->integer('player1_score');
                $table->integer('player2_score');
                $table->integer('player1_point');
                $table->integer('player2_point');
                $table->integer('winner');
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
        Schema::dropIfExists('gamer_tournament_points');
    }
}
