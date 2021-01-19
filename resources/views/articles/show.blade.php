@extends('layouts.base')

@push('fb-sharing-metatags')
<meta property="og:url" content="{{ Request::url() }}" />
<meta property="og:type" content="website" />
<meta property="og:title" content="{{ $article->title }}" />
<meta property="og:description" content="{{ $article->description }}" />

@if ($article->file)
<meta property="og:image" content="{{ $article->image() }}" />
@endif
@endpush

@section('content')
<div>
    <div id="fb-root"></div>
    <div class="container mx-auto pt-4 pb-12">
        @if (!is_null($article->file))
        <img class="w-full" src="{{ $article->image() }}" alt="No Description Yet">
        @endif
        <h4 class="text-xl font-bold"><a class="underline"
                href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h4>
        <span>{{ $article->created_at->diffForHumans() }}</span>
        <p class="mt-6">{{ $article->content }}</p>

        <div class="py-4">
            <div class="fb-share-button" data-href="{{ Request::url() }}" data-layout="button_count">
            </div>
        </div>
    </div>
    @endsection

    @push('scripts')
    <script>
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];

            if (d.getElementById(id)) return;

            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
            fjs.parentNode.insertBefore(js, fjs);

        }(document, 'script', 'facebook-jssdk'));
    </script>
    @endpush