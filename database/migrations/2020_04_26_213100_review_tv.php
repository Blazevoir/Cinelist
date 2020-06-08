<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReviewTv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
      public function up(){
    Schema::create('reviewtv', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('iduser')->unsigned();
            $table->bigInteger('idtv')->unsigned();
            $table->longtext('content');
            $table->bigInteger('upvotes')->unsigned()->default(0);
            $table->bigInteger('downvotes')->unsigned()->default(0);
            $table->bigInteger('reports')->unsigned()->default(0);
            $table->foreign('iduser')->references('id')->on('users');
            $table->foreign('idtv')->references('id')->on('tv');
            
            
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
        Schema::dropIfExists('reviewtv');
    }
}