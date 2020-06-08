<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListMovie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
        {
            Schema::create('listmovie', function (Blueprint $table) {
                $table->bigInteger('idlist')->unsigned();
                $table->bigInteger('idmovie')->nullable()->unsigned();
                
                $table->foreign('idlist')->references('id')->on('userlist');
                $table->foreign('idmovie')->references('id')->on('movie');
                
                $table->primary(array('idlist','idmovie'));
                
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
        Schema::dropIfExists('listmovie');
    }
}

