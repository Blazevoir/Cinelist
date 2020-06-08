<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLikedMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userlikedmovie', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('iduser')->unsigned();
            $table->bigInteger('idreviewmovie')->unsigned();
            $table->bigInteger('idmovie')->unsigned();
            $table->boolean('tipo');
            
            $table->foreign('iduser')->references('id')->on('users');
            $table->foreign('idreviewmovie')->references('id')->on('review');
            $table->foreign('idmovie')->references('id')->on('movie');
            
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
        Schema::dropIfExists('userlikedmovie');
    }
}
