@extends('layouts.base')

@section('content')
<div>
    <div class="container mx-auto pt-4 pb-12">
        @if (!is_null($article->file))
        <img class="w-full" src="{{ $article->image() }}" alt="No Description Yet">
        @endif
        <h4 class="text-xl font-bold"><a class="underline"
                href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h4>
        <span>{{ $article->created_at->diffForHumans() }}</span>
        <p class="mt-6">{{ $article->content }}</p>
    </div>
</div>
@endsection