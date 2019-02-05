<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Settings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->text('consumer_key');
            $table->text('consumer_secret');
            $table->text('access_token');
            $table->text('access_secret');
            $table->string('timezone');
            $table->string('bot_power');
            $table->string('chat_power');
            $table->string('archive_power');
            $table->string('schedule_power');
            $table->string('onfollow_power');
            $table->string('stop_registration');
            $table->string('hide_error_log');
            $table->string('logo');
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
        Schema::dropIfExists('settings');
    }
}
