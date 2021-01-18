@extends('layouts.base')

@section('content')
<div>
    <div class="container mx-auto pt-4">
        <h4 class="text-xl font-bold"><a class=" underline"
                href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h4>
        <span>{{ $article->created_at->diffForHumans() }}</span>
        <p class="mt-6">{{ Str::limit($article->content, 80, '...') }}</p>
    </div>
</div>
@endsection