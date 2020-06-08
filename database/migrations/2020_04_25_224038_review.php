<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Review extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
      public function up(){
    Schema::create('review', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('iduser')->unsigned();
            $table->bigInteger('idmovie')->unsigned();
            $table->longtext('content');
            $table->bigInteger('upvotes')->unsigned()->default(0);
            $table->bigInteger('downvotes')->unsigned()->default(0);
            $table->bigInteger('reports')->unsigned()->default(0);
            $table->foreign('iduser')->references('id')->on('users');
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
        Schema::dropIfExists('review');
    }
}