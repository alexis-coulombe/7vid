<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('channel_settings', static function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('channel_id');
            $table->foreign('channel_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('channel_id');

            $table->text('about');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('channel_settings');
    }
}
