<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->integer('item_id');
            $table->integer('user_id');
            $table->tinyInteger('status');
            $table->string('name')->nullable();
            $table->integer('region_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('address')->nullable();
            $table->text('comment')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->integer('price')->nullable();
            $table->tinyInteger('quantum')->default(1);
            $table->integer('count')->nullable();
            $table->text('delivery_info')->nullable();
            $table->text('payment_requirement')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goods', function(Blueprint $table) {
            $table->dropForeign('goods_user_id_foreign');
        });

        Schema::drop('goods');
    }
}
