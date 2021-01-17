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

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->be($this->user = User::factory()->create());
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

        $articleData['user_id'] = $this->user->id;

        $response = $this->post(route('user.articles.store', $articleData));

        $this->assertTrue(Article::where('slug', Str::slug($articleData['title']))->exists());

        $response->assertRedirect(route('user.articles.index'));
    }

    /** @group articles */
    public function test_a_user_can_view_own_article_edit_page()
    {
        $this->withoutExceptionHandling();

        $articleData = Article::factory()->make()->toArray();

        $articleData['slug'] = Str::slug($articleData['title']);

        $articleData['user_id'] = $this->user->id;

        $article = Article::create($articleData);

        $response = $this->get(route('user.articles.edit', $article));
        
        $response->assertOk();
        
    }

    /** @group articles */
    public function test_a_user_can_update_own_article()
    {
        $this->withoutExceptionHandling();

        $articleData = Article::factory()->make()->toArray();

        $articleData['slug'] = Str::slug($articleData['title']);

        $articleData['user_id'] = $this->user->id;

        $article = Article::create($articleData);

        $response = $this->patch(route('user.articles.update', $article), [
            'title' => 'New Article Title',
            'content' => 'Lorem ipsum sit dolor amet'
        ]);

        $this->assertEquals(Str::slug('New Article Title'), $article->fresh()->slug);
        $this->assertEquals('Lorem ipsum sit dolor amet', $article->fresh()->content);

        $response->assertRedirect(route('user.articles.index'));
        

    }
}
