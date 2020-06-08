<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FavoriteTv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
    Schema::create('favoritetv', function (Blueprint $table) {
            $table->bigInteger('iduser')->unsigned();
            $table->bigInteger('idtv')->unsigned();
            
            $table->foreign('iduser')->references('id')->on('users');
            $table->foreign('idtv')->references('id')->on('tv');
            
            $table->primary(array('iduser','idtv'));
            
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
        Schema::dropIfExists('favoritetv');
    }
}
