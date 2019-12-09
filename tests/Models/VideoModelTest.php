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
        $video = new Video();
        $video->setAuthorId(1);
        $video->setCategoryId(1);
        $video->setTitle('Title');
        $video->setDescription('Description');
        $video->setExtension('mp4');
        $video->setDuration(1235);
        $video->setFrameRate(60);
        $video->setMimeType('video/mp4');
        $video->setLocation('/test/video');
        $video->setThumbnail('/test/img');
        $video->setViewsCount(43600);

        $this->assertEquals(1, $video->getAuthorId());
        $this->assertEquals(1, $video->getCategoryId());
        $this->assertEquals('Title', $video->getTitle());
        $this->assertEquals('Description', $video->getDescription());
        $this->assertEquals('mp4', $video->getExtension());
        $this->assertEquals( 1235, $video->getDuration());
        $this->assertEquals( 60, $video->getFrameRate());
        $this->assertEquals( 'video/mp4', $video->getMimeType());
        $this->assertEquals( '/test/video', $video->getLocation());
        $this->assertEquals( '/test/img', $video->getThumbnail());
        $this->assertEquals( 43600, $video->getViewsCount());
        $this->assertEquals( '43,600', $video->getFormatedViewsCount());
    }
}
