@extends('layouts.app-sidebar')

@section('content')
    @include('components.skills')
    @include('components.experience')
    @include('components.education')
    @include('components.projects')
    @include('components.accomplishments')

    <footer class="border-t border-gray-500 text-center text-gray-500 text-sm mt-16 pt-6">
        &copy; {{ date('Y') }} Chris Kankiewicz

        <span class="mx-1">
            &bull;
        </span>

        <a href="https://github.com/PHLAK/chriskankiewicz.com" class="hover:underline">
            View source on GitHub
        </a>
    </footer>
@endsection
