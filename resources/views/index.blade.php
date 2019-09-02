@extends('layouts.app-sidebar')

@section('content')
    @include('components.skills')
    @include('components.experience')
    @include('components.education')
    @include('components.projects')
    @include('components.accomplishments')

    <footer class="bg-gray-200 text-center text-gray-600 p-4 -mx-6 -mb-6">
        &copy; {{ date('Y') }} Chris Kankiewicz

        <span class="mx-1">
            &bull;
        </span>

        <a href="https://github.com/PHLAK/chriskankiewicz.com" class="underline">
            View source on GitHub
        </a>
    </footer>
@endsection
