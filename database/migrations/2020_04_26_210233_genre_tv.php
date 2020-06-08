<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GenreTv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genretv', function (Blueprint $table) {
            $table->bigInteger('idgenre')->unsigned();
            $table->bigInteger('idtv')->unsigned();
            
            $table->foreign('idgenre')->references('id')->on('genre');
            $table->foreign('idtv')->references('id')->on('tv');
            
            $table->primary(array('idgenre','idtv'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genretv');
    }
}
