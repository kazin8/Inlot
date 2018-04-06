<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dialog_id')->unsigned();
            $table->boolean('is_individual');
            $table->text('message');
            $table->boolean('is_read');
            $table->timestamps();

            $table->foreign('dialog_id')->references('id')->on('dialogs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function(Blueprint $table) {
            $table->dropForeign('messages_dialog_id_foreign');
        });

        Schema::drop('messages');
    }
}
