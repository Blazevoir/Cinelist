<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Comment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idprofile')->unsigned();
            $table->bigInteger('iduser')->unsigned();
            $table->longtext('content');
            
            $table->foreign('iduser')->references('id')->on('users');
            $table->foreign('idprofile')->references('id')->on('users');
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
        Schema::dropIfExists('comment');
    }
}
