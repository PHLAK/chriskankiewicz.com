@extends('layouts.app-sidebar')

@section('content')
    <div id="navigation" class="bg-gray-800 border-b-4 border-white sticky top-0">
        <ul class="flex items-end text-sm md:text-base">
            @include('components.navigation-item', ['section' => 'experience', 'icon' => 'fa-briefcase'])
            @include('components.navigation-item', ['section' => 'projects', 'icon' => 'fa-coffee'])
            @include('components.navigation-item', ['section' => 'education', 'icon' => 'fa-graduation-cap'])
            @include('components.navigation-item', ['section' => 'accomplishments', 'icon' => 'fa-award'])
        </ul>
    </div>

    <div id="content" class="p-6 lg:max-w-2xl">
        @include('sections.experience')
        @include('sections.projects')
        @include('sections.education')
        @include('sections.accomplishments')
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
