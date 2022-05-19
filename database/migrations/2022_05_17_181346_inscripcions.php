<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Inscripcions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripcions', function (Blueprint $table) {
            $table->id('inscripcio_id');
            $table->unsignedBigInteger('excursio_id');
            $table->unsignedBigInteger('tutor_id');
            $table->unsignedBigInteger('infant_id');
            $table->dateTime('data');
            $table->timestamps();

            $table->foreign('excursio_id')->references('excursio_id')->on('excursions');
            $table->foreign('tutor_id')->references('tutor_id')->on('tutors');
            $table->foreign('infant_id')->references('infant_id')->on('infants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
