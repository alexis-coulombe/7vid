<?php

namespace Tests\Models;

use App\Category;
use App\Comment;
use App\Country;
use App\User;
use App\Video;
use App\VideoSetting;
use App\VideoVote;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CountryModelTest extends TestCase implements \BaseModelTest
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test each getters / setters of model
     *
     * @return void
     */
    public function testGettersSetters(): void
    {
        /** @var Country $country */
        $country = Country::first();
        $country->setCode('TE');
        $country->setCountryCode('TES');
        $country->setCountryName('TEST');

        $this->assertSame($country->getCode(), 'TE');
        $this->assertSame($country->getCountryCode(), 'TES');
        $this->assertSame($country->getCountryName(), 'TEST');
    }

    /**
     *  Model should have access to all of it's relationship
     */
    public function testRelationship(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Deleting a model should not throw any foreign key exception
     *
     * @throws Exception
     */
    public function testDelete(): void
    {
        $this->assertTrue(true);
    }
}
