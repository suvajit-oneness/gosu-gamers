<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamTournamentPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_tournament_points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('team_schedule_id');
            $table->integer('team1_score');
            $table->integer('team2_score');
            $table->integer('team1_point');
            $table->integer('team2_point');
            $table->integer('winner');
            $table->smallInteger('is_active')->default(1);
            $table->smallInteger('is_deleted')->default(0
            );
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
        Schema::dropIfExists('team_tournament_points');
    }
}
