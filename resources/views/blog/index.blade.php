@extends('layouts.app-with-nav')

@section('content')
    <div class="p-6 lg:max-w-2xl">
        @foreach ($posts as $post)
            <div class="mb-8">
                <a href="{{ $post->url() }}" class="flex flex-wrap items-start font-bold text-2xl">
                    {{ $post->title }}
                </a>

                <x-post-metadata :post="$post" />

                @isset($post->featured_image_url)
                    <x-featured-image :post="$post" class="h-40 w-full object-cover" />
                @endisset

                <div class="my-4">
                    @if(Str::of($post->body)->containsAll(['<!-- excerpt -->', '<!-- endexcerpt -->']))
                        {!! markdown(Str::of($post->body)->between('<!-- excerpt -->', '<!-- endexcerpt -->')) !!}
                    @else
                        {!! markdown(Str::of($post->body)->limit(360)) !!}
                    @endif
                </div>
            </div>

            <a href="{{ $post->url() }}" class="block my-4 underline">
                Read More
            </a>

            @if(! $loop->last)
                <hr class="border-t-4 border-teal-600 w-40 my-8">
            @endif
        @endforeach

        <x-paginator :paginator="$posts" />
    </div>
@endsection
