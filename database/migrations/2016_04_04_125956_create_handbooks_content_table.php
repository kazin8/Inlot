<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHandbooksContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_classifier')->create('handbooks_content', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('handbook_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('handbook_id')->references('id')->on('handbooks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_classifier')->table('handbooks_content', function(Blueprint $table) {
            $table->dropForeign('handbooks_content_handbook_id_foreign');
        });
        Schema::connection('pgsql_classifier')->drop('handbooks_content');
    }
}
