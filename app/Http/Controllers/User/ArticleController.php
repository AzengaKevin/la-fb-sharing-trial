<?php

namespace App\Http\Controllers\User;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('user.articles.index', [
            'articles' => $request->user()->articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['bail', 'string', 'required', 'max:255', 'unique:articles'],
            'content' => ['bail', 'required', 'string']
        ]);

        //Add the title slug to the data array

        $data['slug'] = Str::slug($data['title']);

        $data['user_id'] = $request->user()->id;

        //Create the article
        Article::create($data);

        return redirect()->route('user.articles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('user.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => ['bail', 'string', 'required', 'max:255', Rule::unique('articles')->ignore($article->id)],
            'content' => ['bail', 'required', 'string']
        ]);

        $data['slug'] = Str::slug($data['title']);

        $article->update($data);

        return redirect()->route('user.articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
