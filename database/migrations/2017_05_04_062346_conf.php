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
        Schema::create('config', function (Blueprint $table) {
            $table->increments('id');
            $table->text('TWITTER_CONSUMER_KEY');
            $table->text('TWITTER_CONSUMER_SECRET');
            $table->text('TWITTER_ACCESS_TOKEN');
            $table->text('TWITTER_ACCESS_TOKEN_SECRET');
            $table->text('STREAM_TWITTER_CONSUMER_KEY');
            $table->text('STREAM_TWITTER_CONSUMER_SECRET');
            $table->text('STREAM_TWITTER_ACCESS_TOKEN');
            $table->text('STREAM_TWITTER_ACCESS_TOKEN_SECRET');
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
        Schema::dropIfExists('config');
    }
}