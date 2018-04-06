<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterGoodsModelsTableModelIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('goods_models')) {
            Schema::table('goods_models', function(Blueprint $table) {
                $table->integer('model_id')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('goods_models')) {
            Schema::table('goods_models', function(Blueprint $table) {
                $table->integer('model_id')->change();
            });
        }
    }
}
