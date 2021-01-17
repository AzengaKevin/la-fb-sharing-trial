<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleCrudTest extends TestCase
{
    use RefreshDatabase;
    
    /** @group articles */
    public function test_an_article_can_be_create()
    {
        $articleData = Article::factory()->make()->toArray();

        $articleData['slug'] = Str::slug($articleData['title']);

        Article::create($articleData);

        $this->assertTrue(Article::where('slug', $articleData['slug'])->exists());
    }
}
