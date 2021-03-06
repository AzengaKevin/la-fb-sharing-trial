@extends('layouts.base')

@section('content')
<div>
    <div class="container mx-auto pt-4">

        @if ($articles->count())
            <div class="divide-y divide-gray-300">
                @foreach ($articles as $article)
                    <div class="my-6">
                        <div class="flex justify-between">
                            <h4 class="text-xl font-bold"><a class=" underline" href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h4>
                            <span>{{ $article->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="mt-6">{{ Str::limit($article->content, 80, '...') }}</p>
                    </div>

                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection