<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('users', static function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->unique();
            $table->index('name');

            $table->string('email')->unique();
            $table->index('email');

            $table->timestamp('email_verified_at')->nullable();

            $table->string('password');

            $table->string('avatar')->default('default-avatar.png');

            $table->unsignedInteger('country_id')->default(1);
            $table->foreign('country_id')->references('id')->on('countries');
            $table->index('country_id');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
