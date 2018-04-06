<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tires', function(Blueprint $table) {
            $table->increments('id');
            $table->string('diameter')->nullable();
            $table->integer('seasonality_id')->nullable();
            $table->integer('profile_width')->nullable();
            $table->integer('profile_height')->nullable();
            $table->integer('state_id')->nullable();
            $table->string('producer')->nullable();
            $table->string('model')->nullable();
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
        Schema::drop('tires');
    }
}
