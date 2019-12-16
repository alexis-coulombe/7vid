<?php

namespace Tests\Models;

use App\Subscription;
use App\User;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SubscriptionModelTest extends TestCase implements \BaseModelTest
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
        factory(User::class, 1)->create();
        factory(Subscription::class, 1)->create();
    }

    /**
     * Test each getters / setters of model
     *
     * @return void
     */
    public function testGettersSetters(): void
    {
        $this->assertTrue(true);
    }

    /**
     *  Model should have access to all of it's relationship
     */
    public function testRelationship(): void
    {
        /** @var Subscription $subscription */
        $subscription = Subscription::first();

        $this->assertNotNull($subscription->channel);
        $this->assertSame(User::first()->getId(), $subscription->channel->getId());
    }

    /**
     * Deleting a model should not throw any foreign key exception
     *
     * @throws Exception
     */
    public function testDelete(): void
    {
        /** @var Subscription $subscription */
        $subscription = Subscription::first();
        $this->assertTrue($subscription->delete());
    }
}
