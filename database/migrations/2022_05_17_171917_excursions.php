<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Excursions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excursions', function (Blueprint $table) {
            $table->id('excursio_id');
            $table->unsignedBigInteger('tipo_excursio_id');
            $table->string('nom',20);
            $table->float('preu',5,2);
            $table->string('descripcio');
            $table->timestamp('data_inici');
            $table->timestamp('data_fi');
            $table->string('localitzacio',50);
            $table->string('imatge',50);
            $table->string('autoritzacio',50);
            $table->float('lat')->nullable();
            $table->float('long')->nullable();
            $table->timestamps();

            $table->foreign('tipo_excursio_id')->references('tipo_excursio_id')->on('tipo_excursions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('excursions');
    }
}
