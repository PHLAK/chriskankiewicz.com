@extends('layouts.app-with-banner')

@section('content')
    @foreach ($posts as $post)
        <div class="mb-8">
            <a href="{{ $post->url() }}" class="flex flex-wrap items-start font-lato font-bold text-2xl md:text-3xl">
                {{ $post->title }}
            </a>

            <x-post-metadata :post="$post" />

            @isset($post->featured_image_url)
                <x-featured-image :post="$post" class="h-40 w-full object-cover" />
            @endisset

            <div class="my-4">
                @if($post->hasExcerpt())
                    {!! markdown($post->excerpt()) !!}
                @else
                    {!! markdown(Str::of($post->body)->limit(360)) !!}
                @endif
            </div>
        </div>

        <a href="{{ $post->url() }}" class="block my-4 underline">
            Read More
        </a>

        @if(! $loop->last)
            <x-horizontal-rule />
        @endif
    @endforeach

    <x-paginator :paginator="$posts" />
@endsection
