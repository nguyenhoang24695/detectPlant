<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCropPathogenBiochemistcalDrugTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crop_pathogen_biochemistcal_drug', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('crop_pathoden_id')->nullable();
            $table->integer('plant_protection_product')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crop_pathogen_biochemistcal_drug');
    }
}
