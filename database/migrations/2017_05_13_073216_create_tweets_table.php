<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->string('id');
            $table->string('tweet_id');
            $table->string('tweet_created_at');
            $table->string('user_id')->nullable();
            $table->string('user_screen_name')->nullable();
            $table->string('user_name')->nullable();
            $table->string('profile_image_url')->nullable();
            $table->string('city')->nullable();
            $table->string('tweet_text')->nullable();
            $table->string('location')->nullable();
            $table->string('url')->nullable();
            $table->string('description')->nullable();
            $table->string('verified')->nullable();
            $table->string('followers_count')->nullable();
            $table->string('friends_count')->nullable();
            $table->string('statuses_count')->nullable();
            $table->string('user_created_at')->nullable();
            $table->string('lang')->nullable();
            $table->string('geo')->nullable();
            $table->string('coordinates')->nullable();
            $table->string('place')->nullable();
            $table->text('json');
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
        Schema::dropIfExists('tweets');
    }
}
