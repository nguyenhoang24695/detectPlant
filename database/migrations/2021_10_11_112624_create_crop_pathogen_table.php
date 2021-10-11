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
            $table->string('id')->primary();
            $table->integer('crop_id')->nullable();
            $table->integer('pathoden_id')->nullable();
            $table->string('symptom')->nullable();
            $table->string('method_manual')->nullable();
            $table->text('method_mechanical')->nullable();
            $table->text('method_biological')->nullable();
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
