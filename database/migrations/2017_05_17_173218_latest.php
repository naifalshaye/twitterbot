<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Latest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_tweets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('keyword')->nullable();
            $table->string('tweet_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('user_screen_name')->nullable();
            $table->string('user_name')->nullable();
            $table->string('tweet_text')->nullable();
            $table->string('reply')->nullable();
            $table->text('json')->nullable();
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
        Schema::dropIfExists('faq_tweets');
    }
}
