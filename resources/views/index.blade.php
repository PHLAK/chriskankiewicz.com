@extends('layouts.app-sidebar')

@section('content')
    @include('components.skills')
    <hr class="border-t-4 border-teal-600 w-40 my-16">
    @include('components.experience')
    <hr class="border-t-4 border-teal-600 w-40 my-16">
    @include('components.education')
    <hr class="border-t-4 border-teal-600 w-40 my-16">
    @include('components.projects')
    <hr class="border-t-4 border-teal-600 w-40 my-16">
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
