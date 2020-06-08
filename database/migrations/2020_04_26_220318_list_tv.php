<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListTv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
        {
            Schema::create('listtv', function (Blueprint $table) {
                $table->bigInteger('idlist')->unsigned();
                $table->bigInteger('idtv')->nullable()->unsigned();
                
                $table->foreign('idlist')->references('id')->on('userlist');
                $table->foreign('idtv')->references('id')->on('tv');
                
                $table->primary(array('idlist','idtv'));
                
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
        Schema::dropIfExists('listtv');
    }
}

