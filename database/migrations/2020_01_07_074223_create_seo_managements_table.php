<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_managements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('page_name');
            $table->string('slug');
            $table->string('meta_title'); 
            $table->text('meta_keywords');
            $table->text('meta_description');
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
        Schema::dropIfExists('seo_managements');
    }
}
