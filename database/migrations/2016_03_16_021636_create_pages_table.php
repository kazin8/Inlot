<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('creator_id')->unsigned();
            $table->string('name');
            $table->mediumText('full_text');
            $table->string('slug')->unique();
            $table->string('t');
            $table->string('k');
            $table->string('d');
            $table->boolean('active');
            $table->timestamps();
            $table->foreign('creator_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function(Blueprint $table) {
            $table->dropForeign('pages_creator_id_foreign');
        });
        Schema::drop('pages');
    }
}
