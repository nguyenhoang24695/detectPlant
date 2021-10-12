<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCropPathogenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crop_pathogen', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('crop_id')->nullable();
            $table->integer('pathoden_id')->nullable();
            $table->string('symptom', 1024)->nullable();
            $table->string('cause', 1024)->nullable();
            $table->string('recognition', 1024)->nullable();
            $table->string('instruction')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crop_pathogen');
    }
}
