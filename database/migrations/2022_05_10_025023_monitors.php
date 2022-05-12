<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Monitors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('monitors', function (Blueprint $table) {
            $table->id('monitor_id');
            $table->unsignedBigInteger('persona_id');
            $table->unsignedBigInteger('grup_id');
            //$table->timestamps();

            $table->foreign('persona_id')->references('persona_id')->on('persones');
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
        Schema::dropIfExists('monitors');
    }
}
