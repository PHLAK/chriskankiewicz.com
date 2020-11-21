@extends('layouts.app')

@section('content')
    <h3 class="font-lato font-bold text-2xl sm:text-3xl">
        {{ $post->title }}
    </h3>

    <x-post-metadata :post="$post" />

    @isset($post->featured_image_url)
        <x-featured-image :post="$post" />
    @endisset

    <div class="my-4">
        {!! markdown($post->body) !!}
    </div>
@endsection
