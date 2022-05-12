<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Persones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persones', function (Blueprint $table) {
            $table->id('persona_id');
            $table->unsignedBigInteger('poblacio_id');
            $table->string('nom',20);
            $table->string('cognoms',40);
            $table->string('email',50);
            $table->char('telefon',9);
            $table->string('carrer',50);
            $table->char('codi_postal',5);
            $table->date('data_naixement');
            $table->char('dni',10)->unique()->nullable();
            $table->char('targeta_sanitaria',14)->unique()->nullable();
            $table->timestamps();

            $table->foreign('poblacio_id')->references('poblacio_id')->on('poblacions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persones');
    }
}
