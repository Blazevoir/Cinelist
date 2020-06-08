<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLikedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userlikedtv', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('iduser')->unsigned();
            $table->bigInteger('idreviewtv')->unsigned();
            $table->bigInteger('idtv')->unsigned();
            $table->boolean('tipo');
            
            $table->foreign('iduser')->references('id')->on('users');
            $table->foreign('idreviewtv')->references('id')->on('reviewtv');
            $table->foreign('idtv')->references('id')->on('tv');
            
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
        Schema::dropIfExists('userlikedtv');
    }
}
