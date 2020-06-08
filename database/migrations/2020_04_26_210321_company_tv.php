<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompanyTv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
        {
            Schema::create('companytv', function (Blueprint $table) {
                $table->bigInteger('idcompany')->unsigned();
                $table->bigInteger('idtv')->unsigned();
                
                $table->foreign('idcompany')->references('id')->on('company');
                $table->foreign('idtv')->references('id')->on('tv');
                
                $table->primary(array('idcompany','idtv'));
            });
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companytv');
    }
}

