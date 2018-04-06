<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_models', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('goods_id');
            $table->integer('model_id');
            $table->timestamps();

            $table->foreign('goods_id')->references('id')->on('goods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goods_models', function(Blueprint $table) {
            $table->dropForeign('goods_models_goods_id_foreign');
        });

        Schema::drop('goods_models');
    }
}
