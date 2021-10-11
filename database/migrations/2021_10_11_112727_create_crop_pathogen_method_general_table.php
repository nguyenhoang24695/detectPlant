<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCropPathogenMethodGeneralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crop_pathogen_method_general', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('crop_category_stage_id')->nullable();
            $table->integer('method_general_id')->nullable();
            $table->string('content', 1024)->nullable();
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
        Schema::dropIfExists('crop_pathogen_method_general');
    }
}
