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
use PHPUnit\phpDocumentor\Reflection\Types\Integer;
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
     * Test each getters / setters of model
     *
     * @return void
     */
    public function testGettersSetters(): void
    {
        $title = 'title';
        $description = 'description';
        $viewsCount = 1000;
        $formatedViews = '1,000';
        $duration = 1000;
        $extension = 'avi';
        $mimeType = 'video/mp4';
        $location  = 'video/test.mp4';
        $thumbnail = 'img/img.jpg';
        $fps = 70;

        /** @var Video $video */
        $video = Video::first();
        $video->setTitle($title);
        $video->setDescription($description);
        $video->setViewsCount($viewsCount);
        $video->setDuration($duration);
        $video->setExtension($extension);
        $video->setMimeType($mimeType);
        $video->setLocation($location);
        $video->setFrameRate($fps);
        $video->setThumbnail($thumbnail);

        $this->assertEquals($title, $video->getTitle());
        $this->assertEquals($description, $video->getDescription());
        $this->assertEquals($extension, $video->getExtension());
        $this->assertEquals($duration, $video->getDuration());
        $this->assertEquals($fps, $video->getFrameRate());
        $this->assertEquals($mimeType, $video->getMimeType());
        $this->assertEquals($location, $video->getLocation());
        $this->assertEquals($thumbnail, $video->getThumbnail());
        $this->assertEquals($viewsCount, $video->getViewsCount());
        $this->assertEquals($formatedViews, $video->getFormatedViewsCount());
    }

    /**
     *  Model should have access to all of it's relationship
     */
    public function testRelationship(): void
    {
        /** @var Video $video */
        $video = Video::first();

        $this->assertNotNull($video->author());
        $this->assertInstanceOf(User::class, $video->author()->first());

        $this->assertNotNull($video->category());
        $this->assertInstanceOf(Category::class, $video->category()->first());

        $this->assertNotNull($video->votes());
        $this->assertInstanceOf(VideoVote::class, $video->votes()->first());

        $this->assertNotNull($video->setting());
        $this->assertInstanceOf(VideoSetting::class, $video->setting()->first());

        $this->assertNotNull($video->comments());
        $this->assertInstanceOf(Comment::class, $video->comments()->first());
    }

    /**
     * Check if user has voted on a video
     */
    public function testUserHasVoted(): void
    {
        /** @var Video $video */
        $video = Video::first();
        $user = User::first();
        $this->be($user);

        $user->voteVideo(VideoVote::UPVOTE, $video->getId());
        $this->assertTrue($video->userHasVoted(VideoVote::UPVOTE, $user->getId()));

        $user->voteVideo(VideoVote::DOWNVOTE, $video->getId());
        $this->assertTrue($video->userHasVoted(VideoVote::DOWNVOTE, $user->getId()));
        $this->assertFalse($video->userHasVoted(VideoVote::UPVOTE, $user->getId()));

        $user->voteVideo(VideoVote::DOWNVOTE, $video->getId());
        $this->assertFalse($video->userHasVoted(VideoVote::DOWNVOTE, $user->getId()));
        $this->assertFalse($video->userHasVoted(VideoVote::UPVOTE, $user->getId()));
    }

    /**
     * Test vote count
     */
    public function testUpVoteCount(): void
    {
        /** @var Video $video */
        $video = Video::first();

        $this->assertEquals(1, $video->getUpVotes() + $video->getDownVotes());
        $this->assertIsInt($video->getUpVotes());
        $this->assertIsInt($video->getDownVotes());
    }

    /**
     * Test formated title
     */
    public function testFormatedTitle(): void
    {
        /** @var Video $video */
        $video = Video::first();

        $this->assertSame('...', substr($video->getFormatedTitle(1), -3));
    }

    /**
     * Deleting a model should not throw any foreign key exception
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
