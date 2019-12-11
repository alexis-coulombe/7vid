<?php

namespace Tests\Feature;

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
     * Test each getters / setters of comment model
     *
     * @return void
     */
    public function testGettersSetters(): void
    {
        /** @var Comment $comment */
        $comment = Comment::first();
        $comment->setBody('Test!');

        $this->assertSame('Test!', $comment->getBody());
    }

    /**
     *  Comment should have access to all of it's relationship
     */
    public function testRelationship(): void
    {
        /** @var Comment $comment */
        $comment = Comment::first();

        $this->assertNotNull($comment->video);
        $this->assertSame($comment->video->getId(), Video::first()->getId());

        $this->assertNotNull($comment->author);
        $this->assertSame($comment->author->id, User::first()->id);

        $this->assertNotNull($comment->votes);
        $this->assertCount(1, $comment->votes);
    }

    /**
     * Deleting a comment should not throw any foreign key exception
     *
     * @throws Exception
     */
    public function testDelete(): void
    {
        /** @var Comment $comment */
        $comment = Comment::first();
        $this->assertTrue($comment->delete());
    }
}
