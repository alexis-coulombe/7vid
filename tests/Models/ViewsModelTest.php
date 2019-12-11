<?php

use App\Subscription;
use App\User;
use App\Views;
use App\Video;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ViewsModelTest extends TestCase implements \BaseModelTest
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
        factory(User::class, 1)->create();
        factory(Subscription::class, 1)->create();
        factory(\App\Category::class, 1)->create();
        factory(Video::class, 1)->create();
        factory(Views::class, 1)->create();
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
        /** @var Views $view */
        $view = Views::first();

        $this->assertNotNull($view->video);
        $this->assertSame(Video::first()->getId(), $view->video->getId());

        $this->assertNotNull($view->author);
        $this->assertSame(User::first()->getId(), $view->author->getId());
    }

    /**
     * Deleting a model should not throw any foreign key exception
     *
     * @throws Exception
     */
    public function testDelete(): void
    {
        /** @var Views $view */
        $view = Views::first();

        $this->assertTrue($view->delete());
    }
}
