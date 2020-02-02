<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('videos', static function (Blueprint $table) {
            $table->primary('id');
            $table->uuid('id');

            $table->unsignedInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('author_id');

            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->index('category_id');

            $table->string('title');
            $table->index('title');

            $table->mediumText('description');

            $table->string('extension');
            $table->unsignedBigInteger('duration');
            $table->unsignedInteger('frame_rate');
            $table->string('mime_type');
            $table->text('location');
            $table->text('thumbnail');
            $table->unsignedInteger('views_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
}
