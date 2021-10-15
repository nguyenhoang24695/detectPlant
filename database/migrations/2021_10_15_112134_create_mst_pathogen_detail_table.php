<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstPathogenDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_pathogen_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('peat_id')->nullable();
            $table->text('alternative_treatment')->nullable();
            $table->text('bullet_points')->nullable();
            $table->text('chemical_treatment')->nullable();
            $table->string('default_image')->nullable();
            $table->string('eppo')->nullable();
            $table->text('pathogen_images')->nullable();
            $table->text('preventive_measures')->nullable();
            $table->string('spread_risk')->nullable();
            $table->string('stages')->nullable();
            $table->text('symptoms')->nullable();
            $table->text('trigger')->nullable();
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
        Schema::dropIfExists('mst_pathogen_detail');
    }
}
