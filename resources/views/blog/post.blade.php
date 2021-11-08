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

    <div class="flex justify-between items-center space-x-4 border border-gray-200 rounded-lg text-sm p-4 mt-12 md:text-base">
        <div class="flex items-center">
            <i class="fal fa-comment-alt-lines fa-2x text-teal-600 pr-4 hidden xs:block sm:block"></i>

            <div>
                <span class="hidden sm:inline">Let me know what you think.</span>
                Send comments to
                <a href="https://twitter.com/intent/tweet?text={{ urlencode(sprintf("@PHLAK [%s] ", $post->title)) }}" class="underline hover:text-teal-700">@PHLAK</a>.
            </div>
        </div>

        <a href="https://github.com/sponsors/PHLAK" class="flex justify-center items-center bg-gray-200 px-4 py-2 rounded transform transition-transform hover:scale-110 focus:bg-gray-300">
            <i class="fas fa-heart text-pink-500 mr-2"></i> Sponsor
        </a>
    </div>
@endsection

@section('after-content')
    <div class="border-t-2 border-teal-600 px-4 py-6 sm:px-6">
        <div class="container flex justify-between text-sm mx-auto lg:max-w-3xl">
            <div>
                @isset($newer)
                    <a href="{{ $newer->url() }}" class="inline-block border-r-4 border-transparent pr-2 hover:border-teal-600">
                        <i class="fal fa-long-arrow-left"></i> {{ $newer->title }}
                    </a>
                @endisset
            </div>

            <div>
                @isset($older)
                    <a href="{{ $older->url() }}" class="inline-block border-l-4 border-transparent pl-2 hover:border-teal-600">
                        {{ $older->title }} <i class="fal fa-long-arrow-right"></i>
                    </a>
                @endisset
            </div>
        </div>
    </div>
@endsection
