<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tutors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tutors', function (Blueprint $table) {
            $table->id('tutor_id');
            $table->unsignedBigInteger('persona_id');
            $table->timestamps();

            $table->foreign('persona_id')->references('persona_id')->on('persones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tutors');
    }
}
