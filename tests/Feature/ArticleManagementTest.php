<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleManagementTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->be(User::factory()->create());
    }

    /** @group articles */
    public function test_a_user_can_view_own_articles()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('user.articles.index'));

        $response->assertOk();

        $response->assertViewIs('user.articles.index');

        $response->assertViewHas('articles');
    }

    /** @group articles */
    public function test_a_user_can_view_create_article_page()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('user.articles.create'));

        $response->assertOk();

        $response->assertViewIs('user.articles.create');
    }

    /** @group articles */
    public function test_a_user_can_create_a_post()
    {
        $this->withoutExceptionHandling();

        $articleData = Article::factory()->make()->toArray();

        $response = $this->post(route('user.articles.store', $articleData));

        $this->assertTrue(Article::where('slug', Str::slug($articleData['title']))->exists());

        $response->assertRedirect(route('user.articles.index'));
    }
}
