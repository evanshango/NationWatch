<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplyPlusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reply_pluses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reply_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->timestamps();
            $table->foreign('reply_id')->references('id')->on('replies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reply_pluses');
    }
}
