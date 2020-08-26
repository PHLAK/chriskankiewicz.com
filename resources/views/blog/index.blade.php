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

                <div class="text-sm text-gray-600 mt-1">
                    <span class="mr-2" title="{{ $post->publish_date->toDayDateTimeString() }}">
                        <i class="fal fa-calendar-day fa-fw"></i>

                        {{ $post->publish_date->toFormattedDateString() }}
                    </span>

                    @if($post->tags->count() > 0)
                        <span>
                            <i class="fal fa-tags fa-fw"></i>

                            @foreach ($post->tags as $tag)
                                <a href="{{ $tag->slug }}">{{ $tag->name }}</a>
                            @endforeach
                        </span>
                    @endif
                </div>
            </div>

            <div class="my-4">
                {!! markdown($post->excerpt) !!}
            </div>

            @if(! $loop->last)
                <hr class="border-t-4 border-teal-600 w-40 my-8">
            @endif
        @endforeach
    </div>
@endsection
