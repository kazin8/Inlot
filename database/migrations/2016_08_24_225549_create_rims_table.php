<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rims', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('rim_type_id')->nullable();
            $table->integer('diameter')->nullable();
            $table->string('width')->nullable();
            $table->integer('number_of_holes')->nullable();
            $table->integer('hole_diameter_id')->nullable();
            $table->integer('radius_id')->nullable();
            $table->integer('state_id')->nullable();
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
        Schema::drop('rims');
    }
}
