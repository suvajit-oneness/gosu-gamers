<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gamers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fname');
            $table->string('lname');
            $table->integer('country_id');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('mobile');
            $table->string('image');
            $table->string('gender');
            $table->text('description');
            $table->string('ref_code');
            $table->integer('otp'); 
            $table->smallInteger('is_verified');  
            $table->smallInteger('is_active');
            $table->smallInteger('is_deleted');      
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
        Schema::dropIfExists('gamers');
    }
}
