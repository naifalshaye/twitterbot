<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Conf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('twitter_id');
            $table->string('screen_name');
            $table->string('name')->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->string('expire')->nullable();
            $table->text('TWITTER_ACCESS_TOKEN');
            $table->text('TWITTER_ACCESS_TOKEN_SECRET');
            $table->bigInteger('since_id')->nullable();
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
        Schema::dropIfExists('conf');
    }
}