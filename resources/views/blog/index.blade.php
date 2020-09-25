@extends('layouts.app-with-nav')

@section('content')
    <div class="p-6 lg:max-w-2xl">
        @foreach ($posts as $post)
            <div class="mb-8">
                <a href="{{ route('post', [$post->slug]) }}" class="flex flex-wrap items-start text-2xl">
                    <span class="font-bold mr-1">
                        {{ $post->title }}
                    </span>
                </a>

                <x-post-metadata :post="$post" />

                @isset($post->featured_image)
                    <x-featured-image :post="$post" />
                @endisset

                <div class="my-4">
                    @if(Str::of($post->body)->containsAll(['<!-- excerpt -->', '<!-- endexcerpt -->']))
                        {!! markdown(Str::of($post->body)->between('<!-- excerpt -->', '<!-- endexcerpt -->')) !!}
                    @else
                        {!! markdown(Str::of($post->body)->limit(360)) !!}
                    @endif
                </div>
            </div>

            @if(! $loop->last)
                <hr class="border-t-4 border-teal-600 w-40 my-8">
            @endif
        @endforeach

        <x-paginator :paginator="$posts" />
    </div>
@endsection
