<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompanyMovie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
        {
            Schema::create('companymovie', function (Blueprint $table) {
                $table->bigInteger('idcompany')->unsigned();
                $table->bigInteger('idmovie')->unsigned();
                
                $table->foreign('idcompany')->references('id')->on('company');
                $table->foreign('idmovie')->references('id')->on('movie');
                
                $table->primary(array('idcompany','idmovie'));
            });
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companymovie');
    }
}

