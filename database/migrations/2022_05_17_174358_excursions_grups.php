<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExcursionsGrups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excursions_grups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('excursio_id');
            $table->unsignedBigInteger('grup_id');

            $table->foreign('excursio_id')->references('excursio_id')->on('excursions');
            $table->foreign('grup_id')->references('grup_id')->on('grups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('excursions_grups');
    }
}
