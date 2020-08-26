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

                <div class="my-4">
                    {!! markdown($post->excerpt) !!}
                </div>
            </div>

            @if(! $loop->last)
                <hr class="border-t-4 border-teal-600 w-40 my-8">
            @endif
        @endforeach
    </div>
@endsection
