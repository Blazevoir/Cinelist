<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ActorMovie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('actormovie', function (Blueprint $table) {
            $table->bigInteger('idactor')->unsigned();
            $table->bigInteger('idmovie')->unsigned();
            $table->string('character');
            
            $table->foreign('idactor')->references('id')->on('actor');
            $table->foreign('idmovie')->references('id')->on('movie');
            
            $table->primary(array('idactor','idmovie','character'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actormovie');
    }
}
