<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('brand_freeze')->nullable();
            $table->string('model_freeze')->nullable();
            $table->tinyInteger('is_active')->default('1');
            $table->tinyInteger('send_alert')->nullable();
            $table->tinyInteger('send_sms')->nullable();
            $table->integer('type_sensor_id')->unsigned();
            $table->foreign('type_sensor_id')->references('id')->on('type_sensors');
            $table->integer('sector_id')->unsigned();
            $table->foreign('sector_id')->references('id')->on('sectors');
            $table->integer('enterprise_id')->unsigned();
            $table->foreign('enterprise_id')->references('id')->on('enterprises');
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
        Schema::dropIfExists('sensors');
    }
}
