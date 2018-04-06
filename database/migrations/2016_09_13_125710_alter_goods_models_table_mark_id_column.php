<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterGoodsModelsTableMarkIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('goods_models') and !Schema::hasColumn('goods_models', 'mark_id')) {
            Schema::table('goods_models', function(Blueprint $table) {
                $table->integer('mark_id')->nullable();
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
        if (Schema::hasTable('goods_models') and Schema::hasColumn('goods_models', 'mark_id')) {
            Schema::table('goods_models', function(Blueprint $table) {
                $table->dropColumn('mark_id');
            });
        }
    }
}
