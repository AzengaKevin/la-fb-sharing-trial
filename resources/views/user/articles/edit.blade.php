<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form class="" action="{{ route('user.articles.update', $article) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="mt-4">
                    <x-jet-label for="title" value="{{ __('Title') }}" />
                    <x-jet-input id="title" name="title" type="text" class="mt-1 block w-full" autofocus
                        value="{{ old('title') ?? $article->title ?? '' }}" />
                    <x-jet-input-error for="title" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="content" value="{{ __('Content') }}" />
                    <div class="mt-1">
                        <textarea id="content" name="content" rows="3" aria-describedby="contentHelp"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md">
                        {{ old('content') ?? $article->content ?? '' }}
                        </textarea>
                    </div>
                    <p class="mt-2 text-sm text-gray-500" id="contentHelp">
                        The content of article that will be shown to the users reading your article.
                    </p>
                    <x-jet-input-error for="content" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="image" value="{{ __('Image') }}" />
                    <input type="file" name="image" id="image">
                </div>

                <div class="">
                    <x-jet-button class="mt-4">
                        {{ __('Submit') }}
                    </x-jet-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>