<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $maxVideosCount = 100;
        $maxCategoryCount = 10;
        $maxUserCount = 100;
        $maxCommentsCount = 200;

        $faker = Faker\Factory::create();

        // Categories
        for ($i = 0; $i < $maxCategoryCount; $i++) {
            $category = new \App\Category();
            $category->title = $faker->word;
            $category->save();
        }

        // Users
        for ($i = 0; $i < $maxUserCount; $i++) {
            $user = new \App\User();
            $user->name = $faker->name;
            $user->email = $faker->email;
            $user->password = Hash::make($faker->password);
            $user->save();
        }

        // Videos
        for ($i = 0; $i < $maxVideosCount; $i++) {
            $video = new \App\Video();
            $video->author_id = $faker->numberBetween(1, $maxUserCount);
            $video->category_id = $faker->numberBetween(1, $maxCategoryCount);
            $video->title = $faker->word;
            $video->description = $faker->text;
            $video->duration = 600;
            $video->extension = 'mp4';
            $video->location = 'videos/seed.mp4';
            $video->thumbnail = 'images/seed.jpg';
            $video->save();
        }

        // Comments
        for ($i = 0; $i < $maxCommentsCount; $i++) {
            $comment = new \App\Comment();
            $comment->video_id = \App\Video::inRandomOrder()->first()->id;
            $comment->author_id = $faker->numberBetween(1, $maxUserCount);
            $comment->body = $faker->text;
            $comment->save();
        }

    }
}
