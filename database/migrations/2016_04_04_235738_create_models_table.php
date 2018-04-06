<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_classifier')->create('models', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('mark_id');
            $table->string('name');

            $table->foreign('mark_id')->references('id')->on('marks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_classifier')->table('models', function(Blueprint $table) {
            $table->dropForeign('models_mark_id_foreign');
        });
        Schema::connection('pgsql_classifier')->drop('models');
    }
}
