<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_gallery', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('goods_id');
            $table->string('filename');
            $table->string('hash');
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
        Schema::table('goods_gallery', function(Blueprint $table) {
            $table->dropForeign('goods_gallery_goods_id_foreign');
        });

        Schema::drop('goods_gallery');
    }
}
