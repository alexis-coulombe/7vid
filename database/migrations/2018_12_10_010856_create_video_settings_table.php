<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_settings', function (Blueprint $table) {
            $table->increments('id');

            $table->uuid('video_id');
            $table->foreign('video_id')->references('id')->on('videos');
            $table->index('video_id');

            $table->boolean('private');
            $table->boolean('allow_comments');
            $table->boolean('allow_votes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_settings');
    }
}
