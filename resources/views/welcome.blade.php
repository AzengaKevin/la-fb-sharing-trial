<x-guest-layout>
    <nav>
        <div class="container mx-auto my-3 flex items-center justify-between">
            <div class="flex items-center space-x-6">
                <div class="font-bold">
                    <a class="text-xl" href="{{ route('home') }}">{{ config('app.name', 'Facebook Sharing') }}</a>
                </div>
                <div class="flex space-x-3">
                    <a class="text-indigo-900 font-medium" href="{{ route('home') }}">Home</a>
                    <a class="text-indigo-900 font-medium" href="#">Articles</a>
                </div>
            </div>
            <div class="flex itex-center space-x-2">
                <a class="px-2 py-1 text-indigo-700 border-b-2 border-gray-500" href="{{ route('login') }}">Login</a>
                <a class="px-2 py-1 text-indigo-700 border-b-2 border-gray-500"
                    href="{{ route('register') }}">Register</a>
            </div>
        </div>
    </nav>
</x-guest-layout>