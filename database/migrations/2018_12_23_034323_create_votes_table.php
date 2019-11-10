<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');

            $table->uuid('video_id');
            $table->foreign('video_id')->references('id')->on('videos');
            $table->index('video_id');

            $table->unsignedInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users');
            $table->index('author_id');

            $table->boolean('value')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
    }
}
