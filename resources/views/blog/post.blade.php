@extends('layouts.app')

@section('content')
    <h3 class="font-lato font-bold text-2xl md:text-3xl">
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

@section('after-content')
    <div class="border-t-2 border-teal-600 px-4 py-6 sm:px-6">
        <div class="container flex justify-between text-sm mx-auto lg:max-w-3xl">
            <div>
                @isset($next)
                    <a href="{{ $next->url() }}" class="inline-block border-r-4 border-transparent pr-2 hover:border-teal-600">
                        <i class="fal fa-long-arrow-left"></i> {{ $next->title }}
                    </a>
                @endisset
            </div>

            <div>
                @isset($previous)
                    <a href="{{ $previous->url() }}" class="inline-block border-l-4 border-transparent pl-2 hover:border-teal-600">
                        {{ $previous->title }} <i class="fal fa-long-arrow-right"></i>
                    </a>
                @endisset
            </div>
        </div>
    </div>
@endsection
