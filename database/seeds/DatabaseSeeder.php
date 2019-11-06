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

        $icons = [
            "fas fa-air-freshener",
            "fas fa-adjust",
            "fab fa-algolia",
            "fas fa-allergies",
            "fas fa-american-sign-language-interpreting",
            "fab fa-android",
            "fas fa-archive",
            "fab fa-artstation",
            "fas fa-atom",
            "fas fa-baby",
            ];

        // Categories
        for ($i = 0; $i < $maxCategoryCount; $i++) {
            $category = new \App\Category();
            $category->title = $faker->word;
            $category->icon = $icons[$i];
            $category->save();
        }

        $images = ['0smPhoTWYeE.jpg',
                   '0ZPlUMo2lis.jpg',
                   '1g49x5NSWH0.jpg',
                   '4BvvvgTBObw.jpg',
                   '85spsIgccGY.jpg',
                   '-Yw5dLaCXYY.jpg',
                   'APL8RzuQVA0.jpg',
                   'bYuI23mnmDQ.jpg',
                   'cLh4dqj2i4Y.jpg',
                   'dBzUuNUvCwM.jpg',
                   'dE9BUGX4UV8.jpg',
                   'eCpdGoq9gdI.jpg',
                   'fwlEfOEpd_E.jpg',
                   'G0GyVaBP73E.jpg',
                   'HwPgyWk9h-o.jpg',
                   'kbGo1cTa5OE.jpg',
                   'kx_uU9bfQBU.jpg',
                   'L6bfAoC1HS8.jpg',
                   'lwHNPvw2nVA.jpg',
                   'mXlOuM4unSg.jpg',
                   'q36y-w_RjG4.jpg',
                   'qgyNUfMQO_0.jpg',
                   'tYGHavQaxbQ.jpg',
                   'UaSKd83CXsQ.jpg',
                   'ULk5WMgudSY.jpg',
                   'vAxQRGqezXk.jpg',
                   'vg_jQG1jtVg.jpg',
                   'ySkQHAQy7y4.jpg',
                   'YTNeojro-fY.jpg',
                   'ZAk2WOxbLD4.jpg'];

        $user = new \App\User();
        $user->name = 'test123';
        $user->email = 'test@123.com';
        $user->password = Hash::make('123123');
        $user->avatar = 'images/seed/ZAk2WOxbLD4';
        $user->save();

        // Users
        for ($i = 0; $i < $maxUserCount; $i++) {
            $user = new \App\User();
            $user->name = $faker->name;
            $user->email = $faker->email;
            $user->password = Hash::make($faker->password);
            $user->avatar = 'images/seed/' . $images[$faker->numberBetween(0, count($images) - 1)];
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
            $video->thumbnail = 'images/seed/' . $images[$faker->numberBetween(0, count($images) - 1)];
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
