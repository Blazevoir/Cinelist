<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Episode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('episode', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idseason')->unsigned();
            $table->bigInteger('idtv')->unsigned();
            $table->date('release_date')->nullable();
            $table->string('title');
            $table->integer('number')->nullable();
            $table->longtext('description')->nullable();
            $table->integer('season_from')->nullable();
            $table->string('thumbnail')->nullable();
            
            $table->foreign('idtv')->references('id')->on('tv');
            $table->foreign('idseason')->references('id')->on('season');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episode');
    }
}
