<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Movie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie', function (Blueprint $table) {
            $table->id();
            $table->string('imdbid')->nullable();
            $table->string('title');
            $table->string('original_title')->nullable();
            $table->string('original_language')->nullable();
            $table->date('release_date')->nullable();
            $table->string('tagline')->nullable();
            $table->longtext('description')->nullable();
            $table->integer('duration')->default(0)->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('poster')->nullable();
            $table->bigInteger('budget')->default(0);
            $table->bigInteger('revenue')->default(0);
            $table->string('web')->nullable();
            $table->string('status')->nullable();
            $table->string('trailer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie');
    }
}
