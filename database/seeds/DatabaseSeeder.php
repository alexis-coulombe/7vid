<?php

use App\Category;
use App\Video;
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
        \factory(Category::class, $maxCategoryCount);

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

        /*$user = new \App\User();
        $user->name = 'test123';
        $user->email = 'test@123.com';
        $user->password = Hash::make('123123');
        $user->avatar = $images[$faker->numberBetween(0, count($images) - 1)];
        $user->country_id = 1;
        $user->save();*/

        // Users
        factory(\App\User::class, $maxUserCount)->create();
        // Category
        \factory(Category::class, $maxCategoryCount)->create();
        // Videos
        \factory(Video::class, $maxVideosCount)->create();
        // Comments
        \factory(\App\Comment::class, $maxCommentsCount)->create();
        // Video Votes
        \factory(\App\VideoVote::class, $maxVotesCount)->create();
        // Comment Votes
        \factory(\App\CommentVote::class, $maxVotesCount)->create();
        // Subscriptions
        \factory(\App\Subscription::class, $maxSubCount)->create();
        // Views
        \factory(\App\Views::class, $maxVideosCount)->create();
    }
}
