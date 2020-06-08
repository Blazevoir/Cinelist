<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ActorTv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('actortv', function (Blueprint $table) {
            $table->bigInteger('idactor')->unsigned();
            $table->bigInteger('idtv')->unsigned();
            $table->string('character');
            
            $table->foreign('idactor')->references('id')->on('actor');
            $table->foreign('idtv')->references('id')->on('tv');
            
            $table->primary(array('idactor','idtv','character'));
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actortv');
    }
}
