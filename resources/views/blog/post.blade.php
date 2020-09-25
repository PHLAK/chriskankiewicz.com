@extends('layouts.app-with-nav')

@section('content')
    <div id="content" class="p-6 lg:max-w-2xl">
        <h3 class="flex flex-wrap items-start text-2xl">
            <span class="font-bold mr-1">
                {{ $post->title }}
            </span>
        </h3>

        <x-post-metadata :post="$post" />

        @isset($post->featured_image)
            <x-featured-image :post="$post" />
        @endisset

        <div class="my-4">
            {!! markdown($post->body) !!}
        </div>
    </div>
@endsection