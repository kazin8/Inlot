<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_classifier')->create('cities', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('region_id');
            $table->string('name');

            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_classifier')->table('cities', function(Blueprint $table) {
            $table->dropForeign('cities_region_id_foreign');
        });
        Schema::connection('pgsql_classifier')->drop('cities');
    }
}
