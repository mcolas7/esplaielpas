<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InfantsSalut extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('infants_salut', function (Blueprint $table) {
            $table->id('infant_salut_id');
            $table->unsignedBigInteger('infant_id');
            $table->boolean('alergies');
            $table->string('alergia')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('infants_salut');
    }
}
