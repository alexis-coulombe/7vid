<?php

namespace Tests\Models;

use App\Category;
use App\Comment;
use App\User;
use App\Video;
use App\VideoSetting;
use App\VideoVote;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class VideoVoteModelTest extends TestCase implements \BaseModelTest
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
     * Test each getters / setters of model
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
     *  Model should have access to all of it's relationship
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
     * Deleting a model should not throw any foreign key exception
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
