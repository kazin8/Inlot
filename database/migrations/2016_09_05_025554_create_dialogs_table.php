<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDialogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dialogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entity_id')->unsigned();
            $table->integer('individual_id')->unsigned();
            $table->integer('good_id')->unsigned()->nullable();
            $table->boolean('is_entity_deleted');
            $table->boolean('is_individual_deleted');
            $table->timestamps();

            $table->foreign('entity_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('individual_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('good_id')->references('id')->on('goods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dialogs', function(Blueprint $table) {
            $table->dropForeign('dialogs_individual_id_foreign');
            $table->dropForeign('dialogs_entity_id_foreign');
            $table->dropForeign('dialogs_good_id_foreign');
        });

        Schema::drop('dialogs');
    }
}
