<?php

use Faker\Factory;
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
        $faker = Faker\Factory::create();

        $maxVideosCount = 100;
        $maxCategoryCount = 10;
        $maxUserCount = 100;
        $maxCommentsCount = 200;
        $maxVotesCount = 1000;
        $maxSubCount = $faker->numberBetween($maxUserCount / 2, $maxUserCount);

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
            $user->avatar = 'images/avatars/seed.webp';
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
            $video->frame_rate = 15;
            $video->mime_type = 'video/mp4';
            $video->views_count = $faker->numberBetween(1, 1000000);
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

        // Votes
        for ($i = 0; $i < $maxVotesCount; $i++) {
            $vote = new \App\Vote();
            $vote->video_id = \App\Video::inRandomOrder()->first()->id;
            $vote->author_id = $faker->numberBetween(1, $maxUserCount);
            $vote->value = $faker->boolean();
            $vote->save();
        }

        for ($i = 0; $i < $maxSubCount; $i++) {
            $sub = new \App\Subscription();
            $sub->author_id = \App\User::inRandomOrder()->first()->id;
            $sub->user_id = \App\User::inRandomOrder()->first()->id;
            $sub->save();
        }
    }
}
