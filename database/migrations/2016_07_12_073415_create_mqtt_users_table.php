<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMqttUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mqtt_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->boolean('output_enabled');
            $table->string('pw');
            $table->boolean('super');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mqtt_users');
    }
}
