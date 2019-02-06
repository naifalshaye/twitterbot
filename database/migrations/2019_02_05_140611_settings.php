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
            $table->string('bot_power')->default(1);
            $table->string('chat_power')->default(1);
            $table->string('archive_power')->default(1);
            $table->string('schedule_power')->default(1);
            $table->string('onfollow_power')->default(1);
            $table->string('stop_registration')->default(1);
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
