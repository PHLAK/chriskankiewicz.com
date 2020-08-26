@extends('layouts.app-with-nav')

@section('content')
    <div id="content" class="p-6 lg:max-w-2xl">
        <h3 class="flex flex-wrap items-start text-2xl">
            <span class="font-bold mr-1">
                {{ $post->title }}
            </span>
        </h3>

        <div class="text-sm text-gray-600 mt-1">
            <span class="mr-2" title="{{ $post->publish_date->toDayDateTimeString() }}">
                <i class="fal fa-calendar-day fa-fw"></i>

                {{ $post->publish_date->toFormattedDateString() }}
            </span>

            <span>
                <i class="fal fa-tags fa-fw"></i>

                @foreach ($post->tags as $tag)
                    <a href="{{ $tag->slug }}">{{ $tag->name }}</a>
                @endforeach
            </span>
        </div>

        <p class="my-4">
            {!! markdown($post->body) !!}
        </p>
    </div>
@endsection
