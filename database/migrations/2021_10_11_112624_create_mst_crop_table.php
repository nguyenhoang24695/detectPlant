<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstCropTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_crop', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('name_en')->nullable();
            $table->string('scientific_name', 512)->nullable();
            $table->string('family')->nullable();
            $table->string('symbol')->nullable();
            $table->string('synonym_symbol')->nullable();
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
        Schema::dropIfExists('mst_crop');
    }
}
