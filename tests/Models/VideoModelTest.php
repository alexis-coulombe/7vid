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

class VideoModelTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();

        factory(User::class, 1)->create();
        factory(Category::class, 1)->create();
        factory(Video::class, 1)->create();
        factory(VideoVote::class, 1)->create();
        factory(VideoSetting::class, 1)->create();
        factory(Comment::class, 1)->create();
    }

    /**
     * Test each getters / setters of video model
     *
     * @return void
     */
    public function testGettersSetters(): void
    {
        /** @var Video $video */
        $video = Video::first();
        $video->setTitle('Title');
        $video->setDescription('Description');
        $video->setViewsCount(1000);
        $video->setDuration(1000);
        $video->setExtension('avi');
        $video->setMimeType('test/test');
        $video->setLocation('test/test');
        $video->setFrameRate(70);
        $video->setThumbnail('thumbnail');

        $this->assertEquals('Title', $video->getTitle());
        $this->assertEquals('Description', $video->getDescription());
        $this->assertEquals('avi', $video->getExtension());
        $this->assertEquals(1000, $video->getDuration());
        $this->assertEquals(70, $video->getFrameRate());
        $this->assertEquals('test/test', $video->getMimeType());
        $this->assertEquals('test/test', $video->getLocation());
        $this->assertEquals('thumbnail', $video->getThumbnail());
        $this->assertEquals(1000, $video->getViewsCount());
        $this->assertEquals('1,000', $video->getFormatedViewsCount());
    }

    /**
     *  Video should have access to all of it's relationship
     */
    public function testRelationship(): void
    {
        /** @var Video $video */
        $video = Video::first();

        $this->assertNotNull($video->author);
        $this->assertSame($video->author->name, User::first()->name);

        $this->assertNotNull($video->category);
        $this->assertSame($video->category->title, Category::first()->title);

        $this->assertNotNull($video->votes);
        $this->assertSame(count($video->votes), 1);

        $this->assertNotNull($video->setting);
        $this->assertSame($video->setting->video_id, $video->getId());

        $this->assertNotNull($video->comments);
        $this->assertSame(count($video->comments), 1);
    }

    /**
     * Check if user has voted on a video
     */
    public function testUserHasVoted(): void
    {
        /** @var Video $video */
        $video = Video::first();
        $vote = $video->votes->first();

        $this->be(User::first());
        $this->assertTrue($video->userHasVoted($vote->getValue()));
    }

    /**
     * Deleting a video should not throw any foreign key exception
     *
     * @throws Exception
     */
    public function testDelete(): void
    {
        /** @var Video $video */
        $video = Video::first();
        $this->assertTrue($video->delete());
    }
}
