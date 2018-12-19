<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'title' => 'Art & Design'
        ]);
        DB::table('categories')->insert([
            'title' => 'Comedy'
        ]);
        DB::table('categories')->insert([
            'title' => 'Instructional'
        ]);
        DB::table('categories')->insert([
            'title' => 'Food'
        ]);
        DB::table('categories')->insert([
            'title' => 'Music'
        ]);
        DB::table('categories')->insert([
            'title' => 'Sports'
        ]);
        DB::table('categories')->insert([
            'title' => 'Gaming'
        ]);
    }
}
