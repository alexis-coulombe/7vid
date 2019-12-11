<?php

namespace Tests\Models;

use App\Category;
use App\Comment;
use App\CommentVote;
use App\Country;
use App\User;
use App\Video;
use App\VideoSetting;
use App\VideoVote;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CommentVoteModelTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
        factory(User::class, 1)->create();
        factory(Category::class, 1)->create();
        factory(Video::class, 1)->create();
        factory(Comment::class, 1)->create();
        factory(CommentVote::class, 1)->create();
    }

    /**
     * Test each getters / setters of model
     *
     * @return void
     */
    public function testGettersSetters(): void
    {
        /** @var CommentVote $vote */
        $vote = CommentVote::first();
        $vote->setValue(1);

        $this->assertTrue($vote->getValue());
    }

    /**
     *  Model should have access to all of it's relationship
     */
    public function testRelationship(): void
    {
        /** @var Vote $vote */
        $vote = CommentVote::first();

        $this->assertNotNull($vote->comment);
        $this->assertSame($vote->comment->getId(), Comment::first()->getId());

        $this->assertNotNull($vote->author);
        $this->assertSame($vote->author->id, User::first()->id);
    }

    /**
     * Deleting a model should not throw any foreign key exception
     *
     * @throws Exception
     */
    public function testDelete(): void
    {
        /** @var Vote $vote */
        $vote = Comment::first();
        $this->assertTrue($vote->delete());
    }
}
