<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->boolean('media_type');
            $table->string('media');
            $table->integer('tag1_id')->unsigned();
            $table->integer('tag2_id')->unsigned()->nullable();
            $table->integer('tag3_id')->unsigned()->nullable();
            $table->string('text');
            $table->boolean('is_positive');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tag1_id')->references('id')->on('tags')->onDelete('cascade');
            $table->foreign('tag2_id')->references('id')->on('tags')->onDelete('cascade');
            $table->foreign('tag3_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
