<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTableMaySellColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users') and !Schema::hasColumn('users', 'may_sell')) {
            Schema::table('users', function(Blueprint $table) {
                $table->boolean('may_sell')->default(false);
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
        if (Schema::hasTable('users') and Schema::hasColumn('users', 'may_sell')) {
            Schema::table('users', function(Blueprint $table) {
                $table->dropColumn('may_sell');
            });
        }
    }
}
