<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('mark_id')->nullable();
            $table->integer('model_id')->nullable();
            $table->integer('date_release_id')->nullable();
            $table->integer('run')->nullable();
            $table->integer('state_id')->nullable();
            $table->string('vin')->nullable();
            $table->integer('pts_id')->nullable();
            $table->integer('pts_owner_number_id')->nullable();
            $table->integer('gear_id')->nullable();
            $table->integer('body_id')->nullable();
            $table->integer('color_id')->nullable();
            $table->integer('engine_id')->nullable();
            $table->integer('engine_capacity')->nullable();
            $table->integer('power')->nullable();
            $table->integer('rudder_id')->nullable();
            $table->integer('kpp_id')->nullable();
            $table->boolean('sunroof')->nullable();
            $table->boolean('tinted_windows')->nullable();
            $table->boolean('xenon_headlights')->nullable();
            $table->boolean('alloy_wheels')->nullable();
            $table->boolean('antilock_system')->nullable();
            $table->boolean('traction_control_system')->nullable();
            $table->boolean('stability_system')->nullable();
            $table->boolean('parktronic')->nullable();
            $table->tinyInteger('airbags')->nullable();
            $table->tinyInteger('salon')->nullable();
            $table->tinyInteger('salon_color')->nullable();
            $table->boolean('on_board_computer')->nullable();
            $table->boolean('rain_sensor')->nullable();
            $table->boolean('light_sensor')->nullable();
            $table->boolean('cruise_control')->nullable();
            $table->boolean('navigation_system')->nullable();
            $table->boolean('mirror_heating')->nullable();
            $table->boolean('headlight_washer')->nullable();
            $table->boolean('power_steering')->nullable();
            $table->boolean('central_locking')->nullable();
            $table->boolean('electric_mirrors')->nullable();
            $table->tinyInteger('windows')->nullable();
            $table->tinyInteger('driver_seat')->nullable();
            $table->tinyInteger('passenger_seat')->nullable();
            $table->tinyInteger('steering_control')->nullable();
            $table->boolean('wheel_heating')->nullable();
            $table->boolean('seat_heating')->nullable();
            $table->tinyInteger('climate')->nullable();
            $table->boolean('full_time_alarm')->nullable();
            $table->boolean('immobilizer')->nullable();
            $table->boolean('feedback')->nullable();
            $table->boolean('remote_engine_start')->nullable();
            $table->boolean('cd')->nullable();
            $table->boolean('tv')->nullable();
            $table->tinyInteger('tyre_id')->nullable();
            $table->string('fl_profile_depth')->nullable();
            $table->string('fl_disk_defect')->nullable();
            $table->string('fl_cap_defect')->nullable();
            $table->string('fl_tyre_image')->nullable();
            $table->string('fr_profile_depth')->nullable();
            $table->string('fr_disk_defect')->nullable();
            $table->string('fr_cap_defect')->nullable();
            $table->string('fr_tyre_image')->nullable();
            $table->string('bl_profile_depth')->nullable();
            $table->string('bl_disk_defect')->nullable();
            $table->string('bl_cap_defect')->nullable();
            $table->string('bl_tyre_image')->nullable();
            $table->string('br_profile_depth')->nullable();
            $table->string('br_disk_defect')->nullable();
            $table->string('br_cap_defect')->nullable();
            $table->string('br_tyre_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cars');
    }
}
