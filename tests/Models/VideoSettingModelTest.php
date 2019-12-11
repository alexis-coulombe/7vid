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

class VideoSettingModelTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();

        factory(User::class, 1)->create();
        factory(Category::class, 1)->create();
        factory(Video::class, 1)->create();
        factory(VideoSetting::class, 1)->create();
    }

    /**
     * Test each getters / setters of setting model
     *
     * @return void
     */
    public function testGettersSetters(): void
    {
        /** @var VideoSetting $setting */
        $setting = VideoSetting::first();

        $this->assertNotEmpty($setting->getVideoId());
        $this->assertIsBool($setting->getPrivate());
        $this->assertIsBool($setting->getAllowComments());
        $this->assertIsBool($setting->getAllowVotes());
    }

    /**
     *  Setting should have access to all of it's relationship
     */
    public function testRelationship(): void
    {
        /** @var VideoSetting $setting */
        $setting = VideoSetting::first();

        $this->assertNotNull($setting->video);
        $this->assertNotEmpty($setting->video->getTitle());
    }

    /**
     * Deleting a setting should not throw any foreign key exception
     *
     * @throws Exception
     */
    public function testDelete(): void
    {
        /** @var VideoSetting $setting */
        $setting = VideoSetting::first();
        $this->assertTrue($setting->delete());
    }
}
