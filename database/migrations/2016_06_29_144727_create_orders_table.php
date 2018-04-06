<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('goods_id');
            $table->integer('user_id');
            $table->integer('user_owner_id');
            $table->tinyInteger('status');
            $table->text('comment');
            $table->timestamps();

            $table->foreign('goods_id')->references('id')->on('goods')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_owner_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function(Blueprint $table) {
            $table->dropForeign('orders_goods_id_foreign');
            $table->dropForeign('orders_user_id_foreign');
            $table->dropForeign('orders_user_owner_id_foreign');
        });

        Schema::drop('orders');
    }
}
