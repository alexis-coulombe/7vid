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

class CommentModelTest extends TestCase
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
        $body = 'test';

        /** @var Comment $comment */
        $comment = Comment::first();
        $comment->setBody($body);

        $this->assertSame(Comment::first()->getId(), $comment->getId());
        $this->assertSame(Video::first()->getId(), $comment->getVideoId());
        $this->assertSame(User::first()->getId(), $comment->getAuthorId());
        $this->assertSame($body, $comment->getBody());
    }

    /**
     *  Model should have access to all of it's relationship
     */
    public function testRelationship(): void
    {
        /** @var Comment $comment */
        $comment = Comment::first();

        $this->assertNotNull($comment->video());
        $this->assertInstanceOf(Video::class, $comment->video()->first());

        $this->assertNotNull($comment->author());
        $this->assertInstanceOf(User::class, $comment->author()->first());

        $this->assertNotNull($comment->comment_votes());
        $this->assertInstanceOf(CommentVote::class, $comment->comment_votes()->first());
    }

    /**
     * Check if user has voted on a comment
     */
    public function testUserHasVoted(): void
    {
        /** @var Comment $comment */
        $comment = Comment::first();
        /** @var User $user */
        $user = User::first();
        $this->be($user);

        $user->voteComment(CommentVote::UPVOTE, $comment->getId());
        $this->assertTrue($comment->userHasVoted(CommentVote::UPVOTE, $user->getId()));

        $user->voteComment(CommentVote::DOWNVOTE, $comment->getId());
        $this->assertTrue($comment->userHasVoted(CommentVote::DOWNVOTE, $user->getId()));
        $this->assertFalse($comment->userHasVoted(CommentVote::UPVOTE, $user->getId()));

        $user->voteComment(CommentVote::DOWNVOTE, $comment->getId());
        $this->assertFalse($comment->userHasVoted(CommentVote::DOWNVOTE, $user->getId()));
        $this->assertFalse($comment->userHasVoted(CommentVote::UPVOTE, $user->getId()));
    }

    /**
     * Deleting a model should not throw any foreign key exception
     *
     * @throws Exception
     */
    public function testDelete(): void
    {
        /** @var Comment $comment */
        $comment = Comment::first();
        $this->assertTrue($comment->delete());
    }

    /**
     * Test number of upvotes / downvotes of comment
     */
    public function testUpVotesDownVotes(): void
    {
        /** @var Comment $comment */
        $comment = Comment::first();

        $this->assertNotSame($comment->getUpVotes(), $comment->getDownVotes());
        $this->assertSame(1, $comment->getUpVotes() + $comment->getDownVotes());
    }
}
