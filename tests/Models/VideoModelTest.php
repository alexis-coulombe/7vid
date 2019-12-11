<?php

namespace Tests\Feature;

use App\User;
use App\Video;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoModelTest extends TestCase
{
    /**
     * Test each getters of model
     *
     * @return void
     */
    public function testModelGetters(): void
    {
        /** @var Video $video */
        $video = Video::first();
        $video->setTitle('Title');
        $video->setDescription('Description');
        $video->setViewsCount(1000);
        $video->setDuration(1000);

        $this->assertEquals('Title', $video->getTitle());
        $this->assertEquals('Description', $video->getDescription());
        $this->assertEquals('mp4', $video->getExtension());
        $this->assertEquals(1000, $video->getDuration());
        $this->assertEquals(15, $video->getFrameRate());
        $this->assertEquals('video/mp4', $video->getMimeType());
        $this->assertEquals('videos/seed.mp4', $video->getLocation());
        $this->assertNotEmpty($video->getThumbnail());
        $this->assertEquals(1000, $video->getViewsCount());
        $this->assertEquals( '1,000', $video->getFormatedViewsCount());
    }
}
