<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantPathogenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plant_pathogen', function (Blueprint $table) {
            $table->id();
            $table->string('plant_id');
            $table->string('name');
            $table->string('name_en');
            $table->string('pathogen_class');
            $table->string('scientific_name');
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
        Schema::dropIfExists('plant_pathogen');
    }
}
