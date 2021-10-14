<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstPathogenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_pathogen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('peat_id', 10)->nullable();
            $table->string('name')->nullable();
            $table->string('name_en')->nullable();
            $table->string('pathogen_class', 10)->nullable();
            $table->string('scientific_name')->nullable();
            $table->string('recognition', 1024)->nullable();
            $table->string('instruction',1024)->nullable();
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
        Schema::dropIfExists('mst_pathogen');
    }
}
