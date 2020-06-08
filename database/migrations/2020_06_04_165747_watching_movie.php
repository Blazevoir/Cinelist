<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WatchingMovie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
            Schema::create('watchingmovie', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('iduser')->unsigned();
                $table->bigInteger('idmovie')->unsigned();
                
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
            Schema::dropIfExists('watchingmovie');
        }
}