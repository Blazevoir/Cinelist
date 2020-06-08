<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WatchedEpisode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
            Schema::create('watchedepisode', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('iduser')->unsigned();
                $table->bigInteger('idepisode')->unsigned();
                $table->bigInteger('idseason')->unsigned();
                $table->bigInteger('idtv')->unsigned();
                
                $table->foreign('iduser')->references('id')->on('users');
                $table->foreign('idepisode')->references('id')->on('episode');
                $table->foreign('idseason')->references('id')->on('season');
                $table->foreign('idtv')->references('id')->on('tv');
                
                $table->unique(array('iduser','idepisode','idseason'));
                
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
            Schema::dropIfExists('watchedepisode');
        }
}