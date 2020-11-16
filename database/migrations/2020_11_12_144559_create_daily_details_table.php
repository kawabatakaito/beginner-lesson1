<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('daily_report_id')->nullable();
            $table->unsignedInteger('item_id')->nullable();
            $table->unsignedInteger('employee_id')->nullable();
            $table->boolean('is_oxygen_scavenger')->default(false);
            $table->boolean('is_packaging_material')->default(false);
            $table->boolean('is_filling_gas')->default(false);
            $table->integer('workers_number')->nullable();
            $table->boolean('start_metal_detector_fe_check')->default(false);
            $table->boolean('start_metal_detector_sus_check')->default(false);
            $table->boolean('start_x_detector_fe_check')->default(false);
            $table->boolean('start_x_detector_sus_check')->default(false);
            $table->boolean('start_x_detector_gi_check')->default(false);
            $table->boolean('start_x_detector_pvc_check')->default(false);
            $table->time('started_on')->nullable();
            $table->time('finished_on')->nullable();
            $table->integer('pass_amount')->nullable();
            $table->integer('repack_amount')->nullable();
            $table->integer('lightweight')->nullable();
            $table->integer('appearance')->nullable();
            $table->integer('metal_removal')->nullable();
            $table->integer('x_removal')->nullable();
            $table->boolean('stop_metal_detector_fe_check')->default(false);
            $table->boolean('stop_metal_detector_sus_check')->default(false);
            $table->boolean('stop_x_detector_fe_check')->default(false);
            $table->boolean('stop_x_detector_sus_check')->default(false);
            $table->boolean('stop_x_detector_gi_check')->default(false);
            $table->boolean('stop_x_detector_pvc_check')->default(false);
            $table->string('state')->nullable();
            $table->boolean('is_finished')->default(false);
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
        Schema::dropIfExists('daily_details');
    }
}
