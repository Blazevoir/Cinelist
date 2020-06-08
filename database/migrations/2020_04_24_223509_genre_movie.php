<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GenreMovie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genremovie', function (Blueprint $table) {
            $table->bigInteger('idgenre')->unsigned();
            $table->bigInteger('idmovie')->unsigned();
            
            $table->foreign('idgenre')->references('id')->on('genre');
            $table->foreign('idmovie')->references('id')->on('movie');
            
            $table->primary(array('idgenre','idmovie'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genremovie');
    }
}
