<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterGoodsTableActiveColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('goods') and !Schema::hasColumn('goods', 'active')) {
            Schema::table('goods', function(Blueprint $table) {
                $table->boolean('active')->default(false);
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
        if (Schema::hasTable('goods') and Schema::hasColumn('goods', 'active')) {
            Schema::table('goods', function(Blueprint $table) {
                $table->dropColumn('active');
            });
        }
    }
}
