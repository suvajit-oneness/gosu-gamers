<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentPercentageMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournament_percentage_maps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tournament_id');
            $table->decimal('percentage_value',8,2);
            $table->decimal('percentage_amt',8,2);
            $table->integer('user_rank');
            $table->integer('user_id');
            $table->integer('team_id');
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
        Schema::dropIfExists('tournament_percentage_maps');
    }
}
