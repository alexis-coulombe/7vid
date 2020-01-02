<?php

namespace Tests\Models;

use App\Category;
use App\ChannelSetting;
use App\Comment;
use App\CommentVote;
use App\Country;
use App\Subscription;
use App\User;
use App\Video;
use App\VideoVote;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Count;
use Tests\TestCase;

class UserModelTest extends TestCase
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
        $name = 'test';
        $email = 'test@test.com';
        $avatar = 'avatar.jpg';
        $password = 'password';
        $countryId = 1;

        /** @var User $user */
        $user = User::first();
        $user->setName($name);
        $user->setEmail($email);
        $user->setAvatar($avatar);
        $user->setPassword($password);
        $user->setCountryId($countryId);

        $this->assertEquals($name, $user->getName());
        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals($avatar, $user->getAvatar());
        $this->assertEquals($countryId, $user->getCountryId());
        $this->assertTrue(Hash::check($password, $user->getPassword()));
    }

    /**
     *  Model should have access to all of it's relationship
     */
    public function testRelationship(): void
    {
        /** @var User $user */
        $user = User::first();

        $this->assertNotNull($user->videos());
        $this->assertInstanceOf(Video::class, $user->videos()->first());

        $this->assertNotNull($user->country());
        $this->assertInstanceOf(Country::class, $user->country()->first());

        $this->assertNotNull($user->setting());
        $this->assertInstanceOf(ChannelSetting::class, $user->setting()->first());

        $this->assertNotNull($user->comments());
        $this->assertInstanceOf(Comment::class, $user->comments()->first());

        $this->assertNotNull($user->videoVotes());
        $this->assertInstanceOf(VideoVote::class, $user->videoVotes()->first());

        $this->assertNotNull($user->commentVotes());
        $this->assertInstanceOf(CommentVote::class, $user->commentVotes()->first());

        $this->assertNotNull($user->subscriptions());
        $this->assertInstanceOf(Subscription::class, $user->subscriptions()->first());

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

    /**
     * Test subscriptions count
     */
    public function testSubscriptionCount(): void
    {
        /** @var User $user */
        $user = User::first();
        $this->be($user);

        $this->assertSame(1, $user->getSubscriptionCount());
        $this->assertSame(1, $user->getSubscriptionCount(User::first()->getId()));

        $user->unsubscribe(User::first()->getId());
        $this->assertSame(0, $user->getSubscriptionCount());
        $this->assertSame(0, $user->getSubscriptionCount(User::first()->getId()));
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
        $this->assertNull(User::first());
    }

    /**
     * Test upVoting / downVoting and unVoting of a video
     * @throws Exception
     */
    public function testVoteVideo(): void
    {
        /** @var Video $video */
        $video = Video::first();
        /** @var User $user */
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
}
