<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Infants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('infants', function (Blueprint $table) {
            $table->id('infant_id');
            $table->unsignedBigInteger('persona_id');
            $table->unsignedBigInteger('grup_id');
            $table->unsignedBigInteger('curs_id');
            $table->timestamps();

            $table->foreign('persona_id')->references('persona_id')->on('persones');
            $table->foreign('grup_id')->references('grup_id')->on('grups');
            $table->foreign('curs_id')->references('curs_id')->on('cursos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infants');
    }
}
