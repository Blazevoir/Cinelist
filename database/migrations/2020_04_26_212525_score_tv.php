<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ScoreTv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
            Schema::create('scoretv', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('iduser')->unsigned();
                $table->bigInteger('idtv')->unsigned();
                $table->double('score')->nullable();
                
                $table->foreign('iduser')->references('id')->on('users');
                $table->foreign('idtv')->references('id')->on('tv');
                
                $table->unique(array('iduser','idtv'));
                
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
            Schema::dropIfExists('scoretv');
        }
    }