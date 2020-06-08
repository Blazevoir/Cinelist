<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Friend extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
        {
            Schema::create('friend', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('iduser1')->unsigned();
                $table->bigInteger('iduser2')->unsigned();
                $table->date('confirmed_at')->nullable();
                $table->date('declined_at')->nullable();
                $table->boolean('pending')->default(true);
                
                $table->foreign('iduser1')->references('id')->on('users');
                $table->foreign('iduser2')->references('id')->on('users');
                
                $table->unique(array('iduser1','iduser2'));
                
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
        Schema::dropIfExists('friend');
    }
}