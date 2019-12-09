<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('countries', static function (Blueprint $table) {
            $table->increments('id');

            $table->string('country_code')->unique();
            $table->index('country_code');

            $table->string('country_name')->unique();
            $table->index('country_name');

            $table->string('code')->unique();
            $table->index('code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        //Schema::dropIfExists('countries');
    }
}
