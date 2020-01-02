<?php

use App\Category;
use App\ChannelSetting;
use App\Comment;
use App\CommentVote;
use App\Subscription;
use App\User;
use App\Video;
use App\VideoVote;
use Tests\TestCase;
use \Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class BaseModelTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
        factory(User::class, 1)->create();
        factory(ChannelSetting::class, 1)->create();
        factory(Subscription::class, 1)->create();
        factory(Category::class, 1)->create();
        factory(Video::class, 1)->create();
        factory(Comment::class, 1)->create();
        factory(VideoVote::class, 1)->create();
        factory(CommentVote::class, 1)->create();
    }

    /**
     * Test each getters / setters of model
     *
     * @return void
     */
    abstract public function testGettersSetters(): void;

    /**
     *  Model should have access to all of it's relationship
     */
    abstract public function testRelationship(): void;

    /**
     * Deleting a model should not throw any foreign key exception
     *
     * @throws Exception
     */
    abstract public function testDelete(): void;
}
