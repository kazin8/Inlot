<?php

use Illuminate\Database\Migrations\Migration;

class CreateClassifierSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE SCHEMA classifier");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP SCHEMA classifier CASCADE");
    }
}
