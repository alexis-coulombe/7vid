<?php

namespace Tests\Feature;

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

class CountryModelTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test each getters / setters of country model
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
}
