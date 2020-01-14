<?php

namespace Tests\Models;

use App\Category;
use App\Comment;
use App\CommentVote;
use App\User;
use App\Video;
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
     * @throws Exception
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
        $this->assertIsInt($comment->getUpVotes());
        $this->assertIsInt($comment->getDownVotes());
    }

    public function testGetCommentsByFilter(): void
    {
        /** @var Comment $firstComment */
        $firstComment = Comment::first();
        $firstComment->save();

        /** @var Comment $secondComment */
        $secondComment = new Comment();
        $secondComment->setBody('test');
        $secondComment->setVideoId(Video::first()->getId());
        $secondComment->setAuthorId(User::first()->getId());
        $secondComment->save();

        /** @var CommentVote $secondVote */
        for($i = 0; $i < 2; $i++){
            $secondVote = new CommentVote();
            $secondVote->setAuthorId(User::first()->getId());
            $secondVote->setCommentId($secondComment->getId());
            $secondVote->setValue(1);
            $secondVote->save();
        }

        $comments = Comment::getByFilter(Comment::FILTER_DATE, Video::first()->getId())->get();
        $this->assertCount(Video::first()->comments()->count(), $comments);

        $comments = Comment::getByFilter(Comment::FILTER_VOTE_COUNT, Video::first()->getId())->get();
        $this->assertCount(Video::first()->comments()->count(), $comments);

        if($firstComment->comment_votes()->count() > $secondComment->comment_votes()->count()) {
            $this->assertSame($firstComment->getId(), $comments->first()->getId());
        } else {
            $this->assertSame($secondComment->getId(), $comments->first()->getId());
        }

        $comments = Comment::getByFilter(Comment::FILTER_RATED, Video::first()->getId())->get();
        $this->assertCount(Video::first()->comments()->count(), $comments);

        if($firstComment->getUpVotes() > $secondComment->getUpVotes()) {
            $this->assertSame($firstComment->getId(), $comments->first()->getId());
        } else {
            $this->assertSame($secondComment->getId(), $comments->first()->getId());
        }
    }
}
