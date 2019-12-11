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

class CategoryModelTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
        factory(User::class, 1)->create();
        factory(Category::class, 1)->create();
        factory(Video::class, 1)->create();
    }

    /**
     * Test each getters / setters of category model
     *
     * @return void
     */
    public function testGettersSetters(): void
    {
        /** @var Category $category */
        $category = Category::first();
        $category->setTitle('title');
        $category->setIcon('icon');

        $this->assertSame('title', $category->getTitle());
        $this->assertSame('icon', $category->getIcon());
        $this->assertSame(1, $category->getVideosCount());
        $this->assertCount(1, $category->getVideos('views_count'));
    }

    /**
     *  Category should have access to all of it's relationship
     */
    public function testRelationship(): void
    {
        /** @var VideoVote $category */
        $category = Category::first();

        $this->assertNotNull($category->videos);
        $this->assertSame(count($category->videos), 1);
    }
}
