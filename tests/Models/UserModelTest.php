<?php

namespace Tests\Models;

use App\Category;
use App\ChannelSetting;
use App\Comment;
use App\CommentVote;
use App\Subscription;
use App\User;
use App\Video;
use App\VideoSetting;
use App\VideoVote;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserModelTest extends TestCase implements \BaseModelTest
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
        factory(User::class, 1)->create();
        factory(ChannelSetting::class, 1)->create();
        factory(Subscription::class, 1)->create();
        factory(Category::class, 1)->create();
        factory(Video::class, 1)->create();
        factory(Comment::class, 1)->create();
        factory(VideoVote::class, 1)->create();
        factory(CommentVote::class, 1)->create();
    }

    /**
     * Test each getters / setters of model
     *
     * @return void
     */
    public function testGettersSetters(): void
    {
        /** @var User $user */
        $user = User::first();
        $user->setName('test');
        $user->setEmail('test@test.com');
        $user->setAvatar('avatar.jpg');
        $user->setPassword('password');

        $this->assertEquals('test', $user->getName());
        $this->assertEquals('test@test.com', $user->getEmail());
        $this->assertEquals('avatar.jpg', $user->getAvatar());
        $this->assertTrue(Hash::check('password', $user->getPassword()));
    }

    /**
     *  Model should have access to all of it's relationship
     */
    public function testRelationship(): void
    {
        /** @var User $user */
        $user = User::first();

        $this->assertNotNull($user->videos);
        $this->assertCount(1, $user->videos);

        $this->assertNotNull($user->country);

        $this->assertNotNull($user->setting);
        $this->assertSame($user->setting->id, ChannelSetting::first()->id);

        $this->assertNotNull($user->comments);
        $this->assertCount(1, $user->comments);

        $this->assertNotNull($user->videoVotes);
        $this->assertCount(1, $user->videoVotes);

        $this->assertNotNull($user->commentVotes);
        $this->assertCount(1, $user->commentVotes);

        $this->assertNotNull($user->subscriptions);
        $this->assertCount(1, $user->subscriptions);

    }

    /**
     * Check if user is subscribed to another user
     */
    public function testIsSubscribed(): void
    {
        /** @var User $user */
        $user = User::first();
        $this->be($user);

        $this->assertTrue($user->isSubscribed(User::first()->getId()));
    }

    /**
     * Test subscribing and unsubscribing from another user
     */
    public function testSubscribeUnsubscribe(): void
    {
        /** @var User $user */
        $user = User::first();
        $this->be($user);

        $this->assertTrue($user->isSubscribed(User::first()->getId()));

        $user->unsubscribe(User::first()->getId());
        $this->assertFalse($user->isSubscribed(User::first()->getId()));

        $user->subscribe(User::first()->getId());
        $this->assertTrue($user->isSubscribed(User::first()->getId()));
    }

    public function testSubscriptionCount(): void
    {
        /** @var User $user */
        $user = User::first();
        $this->be($user);

        $this->assertSame(1, $user->getSubscriptionCount());
        $this->assertSame(1, $user->getSubscriptionCount(User::first()->getId()));
    }

    /**
     * Deleting a model should not throw any foreign key exception
     *
     * @throws Exception
     */
    public function testDelete(): void
    {
        /** @var User $user */
        $user = User::first();
        $this->assertTrue($user->delete());
    }
}
