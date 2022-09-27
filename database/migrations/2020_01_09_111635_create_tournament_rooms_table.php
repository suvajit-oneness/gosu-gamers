<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournament_rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tournament_id');
            $table->integer('game_room_id'); 
            $table->string('room_code');
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
        Schema::dropIfExists('tournament_rooms');
    }
}
