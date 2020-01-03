<?php

use App\Category;
use App\Comment;
use App\CommentVote;
use App\Subscription;
use App\User;
use App\Video;
use App\VideoSetting;
use App\VideoVote;
use App\Views;
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

        $maxVideosCount = 5000;
        $maxCategoryCount = 10;
        $maxUserCount = 5000;
        $maxCommentsCount = 8000;
        $maxVotesCount = 20000;
        $maxSubCount = $faker->numberBetween($maxUserCount / 2, $maxUserCount);

        $user = new \App\User();
        $user->name = 'test123';
        $user->email = 'test@123.com';
        $user->password = Hash::make('123123');
        $user->avatar = '0smPhoTWYeE.jpg';
        $user->country_id = 1;
        $user->save();

        echo 'Users' . PHP_EOL;
        factory(User::class, $maxUserCount)->create();
        echo 'Category'. PHP_EOL;
        \factory(Category::class, $maxCategoryCount)->create();
        echo 'Videos'. PHP_EOL;
        \factory(Video::class, $maxVideosCount)->create();
        echo 'Videos settings'. PHP_EOL;

        foreach(Video::all() as $video){
            /** @var VideoSetting $setting */
            $setting = new VideoSetting();
            $setting->setVideoId($video->getId());
            $setting->setPrivate($faker->boolean);
            $setting->setAllowComments($faker->boolean);
            $setting->setAllowVotes($faker->boolean);
        }

        echo 'Comments'. PHP_EOL;
        \factory(Comment::class, $maxCommentsCount)->create();
        echo 'Video Votes'. PHP_EOL;
        \factory(VideoVote::class, $maxVotesCount)->create();
        echo 'Comment Votes'. PHP_EOL;
        \factory(CommentVote::class, $maxVotesCount)->create();
        echo 'Subscriptions'. PHP_EOL;
        \factory(Subscription::class, $maxSubCount)->create();
        echo 'Views'. PHP_EOL;
        \factory(Views::class, $maxVideosCount)->create();
    }
}
