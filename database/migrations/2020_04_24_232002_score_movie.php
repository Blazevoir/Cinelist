<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ScoreMovie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scoremovie', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('iduser')->unsigned();
            $table->bigInteger('idmovie')->unsigned();
            $table->double('score')->nullable();
            
            $table->foreign('iduser')->references('id')->on('users');
            $table->foreign('idmovie')->references('id')->on('movie');
            
            $table->unique(array('iduser','idmovie'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scoremovie');
    }
}
