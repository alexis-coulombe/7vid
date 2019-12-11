<?php

namespace Tests\Feature;

use App\Category;
use App\Comment;
use App\User;
use App\Video;
use App\VideoSetting;
use App\VideoVote;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class VideoVoteModelTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();

        factory(User::class, 1)->create();
        factory(Category::class, 1)->create();
        factory(Video::class, 1)->create();
        factory(VideoVote::class, 1)->create();
    }

    /**
     * Test each getters / setters of vote model
     *
     * @return void
     */
    public function testGettersSetters(): void
    {
        /** @var VideoVote $vote */
        $vote = VideoVote::first();

        $this->assertIsBool($vote->getValue());
    }

    /**
     *  Vote should have access to all of it's relationship
     */
    public function testRelationship(): void
    {
        /** @var VideoVote $vote */
        $vote = VideoVote::first();

        $this->assertNotNull($vote->video);
        $this->assertNotEmpty($vote->video->getTitle());

        $this->assertNotNull($vote->author);
        $this->assertEquals($vote->author->id, User::first()->id);
    }

    /**
     * Check if user has voted on a video
     */
    public function testUserHasVoted(): void
    {
        /** @var VideoVote $vote */
        $vote = VideoVote::first();
        /** @var Video $video */
        $video = $vote->video;

        $this->be(User::first());
        $this->assertTrue($vote->userHasVoted($vote->getValue()));
    }

    /**
     * Deleting a vote should not throw any foreign key exception
     *
     * @throws Exception
     */
    public function testDelete(): void
    {
        /** @var VideoVote $vote */
        $vote = VideoVote::first();
        $this->assertTrue($vote->delete());
    }
}
