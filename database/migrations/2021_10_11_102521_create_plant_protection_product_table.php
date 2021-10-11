<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantProtectionProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plant_protection_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('common_name_manager_id')->nullable();
            $table->string('common_name', 1024)->nullable();
            $table->string('trade_name', 1024)->nullable();
            $table->string('pest_crop', 1024)->nullable();
            $table->string('applicant', 1024)->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plant_protection_product');
    }
}
