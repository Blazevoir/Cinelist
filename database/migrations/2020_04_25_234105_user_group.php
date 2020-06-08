<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
        {
            Schema::create('usergroup', function (Blueprint $table) {
                $table->bigInteger('idgroup')->unsigned();
                $table->bigInteger('iduser')->unsigned();
                
                $table->foreign('idgroup')->references('id')->on('group');
                $table->foreign('iduser')->references('id')->on('users');
                $table->timestamps();
                $table->primary(array('idgroup','iduser'));
            });
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usergroup');
    }
}

