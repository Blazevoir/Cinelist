<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ImageTv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagetv', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idtv')->unsigned();
            $table->string('url')->nullable();
            $table->integer('height')->default(0)->nullable();
            $table->integer('width')->default(0)->nullable();
            
            $table->foreign('idtv')->references('id')->on('tv');
            
            $table->unique(array('idtv','url'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('imagetv');
    }
}
