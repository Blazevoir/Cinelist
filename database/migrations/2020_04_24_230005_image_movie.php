<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ImageMovie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagemovie', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idmovie')->unsigned();
            $table->string('url')->nullable();
            $table->integer('height')->default(0)->nullable();
            $table->integer('width')->default(0)->nullable();
            
            $table->foreign('idmovie')->references('id')->on('movie');
            
            $table->unique(array('idmovie','url'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('imagemovie');
    }
}
