<?php

namespace Tests\Models;

use App\ChannelSetting;
use App\User;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ChannelSettingModelTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
        factory(User::class, 1)->create();
        factory(ChannelSetting::class, 1)->create();
    }


    /**
     * Test each getters / setters of model
     *
     * @return void
     */
    public function testGettersSetters(): void
    {
        /** @var ChannelSetting $setting */
        $setting = ChannelSetting::first();
        $setting->setAbout('test');

        $this->assertSame(User::first()->getId(), $setting->getChannelId());
        $this->assertSame('test', $setting->getAbout());
    }

    /**
     *  Model should have access to all of it's relationship
     */
    public function testRelationship(): void
    {
        /** @var ChannelSetting $setting */
        $setting = ChannelSetting::first();

        $this->assertNotNull($setting->channel);
        $this->assertSame($setting->channel->getId(), User::first()->getId());
    }

    /**
     * Deleting a model should not throw any foreign key exception
     *
     * @throws Exception
     */
    public function testDelete(): void
    {
        /** @var ChannelSetting $setting */
        $setting = ChannelSetting::first();
        $this->assertTrue($setting->delete());
    }
}
