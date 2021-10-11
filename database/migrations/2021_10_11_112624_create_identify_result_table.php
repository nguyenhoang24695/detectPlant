<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentifyResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identify_result', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('identify_user_id')->nullable();
            $table->string('scientific_name')->nullable();
            $table->float('probability', 10, 0)->nullable();
            $table->tinyInteger('type')->nullable();
            $table->integer('source')->nullable();
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
        Schema::dropIfExists('identify_result');
    }
}
