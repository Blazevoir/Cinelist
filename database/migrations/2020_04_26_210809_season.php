<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Season extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
         Schema::create('season', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idtv')->unsigned();
            $table->date('release_date')->nullable();
            $table->string('title');
            $table->integer('number')->nullable();
            $table->integer('total_episodes')->nullable();
            $table->longtext('description')->nullable();
            $table->string('poster')->nullable();
            
            $table->foreign('idtv')->references('id')->on('tv');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('season');
    }
}
