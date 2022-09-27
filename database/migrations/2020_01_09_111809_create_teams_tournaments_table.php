<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams_tournaments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('team_id');
            $table->integer('tournament_id'); 
            $table->string('room_code');
            $table->integer('point'); 
            $table->tinyInteger('payment_status');
            $table->integer('score'); 
            $table->integer('earning');
            $table->integer('currency_id'); 
            $table->tinyInteger('status');
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
        Schema::dropIfExists('teams_tournaments');
    }
}
