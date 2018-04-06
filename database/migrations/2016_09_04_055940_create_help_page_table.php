<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelpPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('help_page', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->mediumText('full_text');
            $table->string('slug')->unique();
            $table->integer('pid')->unsigned()->nullable();
            $table->integer('ord')->unsigned();
            $table->string('t');
            $table->string('k');
            $table->string('d');
            $table->boolean('active');
            $table->timestamps();
            $table->foreign('pid')
                ->references('id')
                ->on('help_category')
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
        Schema::table('help_page', function(Blueprint $table) {
            $table->dropForeign('help_page_pid_foreign');
        });
        Schema::drop('help_page');
    }
}
