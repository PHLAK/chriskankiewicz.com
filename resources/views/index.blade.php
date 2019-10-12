@extends('layouts.app-sidebar')

@section('content')
    <div id="navigation" class="bg-gray-800 border-b-4 border-white sticky top-0">
        @include('components.content-navigation')
    </div>

    <div class="p-6 lg:max-w-2xl">
        @include('components.experience')
        @include('components.projects')
        @include('components.education')
        @include('components.accomplishments')
    </div>

    <footer class="bg-gray-200 text-center text-gray-600 p-4">
        &copy; {{ date('Y') }} Chris Kankiewicz

        <span class="mx-1">
            &bull;
        </span>

        <a href="https://github.com/PHLAK/chriskankiewicz.com" class="underline">
            View source on GitHub
        </a>
    </footer>
@endsection
