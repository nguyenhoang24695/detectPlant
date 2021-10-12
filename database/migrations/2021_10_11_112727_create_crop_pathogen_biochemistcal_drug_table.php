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
        Schema::create('crop_pathogen_biochemical_drug', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('crop_pathogen_id')->nullable();
            $table->integer('crop_protection_product_id')->nullable();
            $table->tinyInteger('type')->nullable();
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
        Schema::dropIfExists('crop_pathogen_biochemical_drug');
    }
}
