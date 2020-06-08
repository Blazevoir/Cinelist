<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('tv', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('original_title')->nullable();
            $table->string('original_language')->nullable();
            $table->date('release_date')->nullable();
            $table->longtext('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('poster')->nullable();
            $table->string('web')->nullable();
            $table->string('status')->nullable();
            $table->string('trailer')->nullable();
            $table->boolean('in_production')->default(false);
            $table->date('next_episode')->nullable();
            $table->integer('total_episodes')->nullable();
            $table->integer('total_seasons')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tv');
    }
}
