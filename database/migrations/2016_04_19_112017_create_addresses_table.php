<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('region_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('address')->nullable();
            $table->string('postcode', 6)->nullable();
            $table->string('description', 1000)->nullable(); //TODO: Условиться с количеством символов описания.
            $table->integer('user_id');
            $table->timestamps();

            $table->foreign('region_id')->references('id')->on('classifier.regions')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('classifier.cities')->onDelete('cascade');
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
        Schema::table('addresses', function(Blueprint $table) {
            $table->dropForeign('addresses_region_id_foreign');
            $table->dropForeign('addresses_city_id_foreign');
            $table->dropForeign('addresses_user_id_foreign');
        });

        Schema::drop('addresses');
    }
}
