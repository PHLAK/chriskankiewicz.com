<!DOCTYPE html>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" href="{{ asset('favicon.png') }}">
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

{{-- TODO: Re-enable when spatie/laravel-feed is working again --}}
{{-- @include('feed::links') --}}

@includeWhen(config('services.google_analytics.tracking_id'), 'components.analytics')

<title>{{ isset($title) ? sprintf('%s • ', $title) : null }}Chris Kankiewicz</title>

<div id="app" class="flex flex-col min-h-screen font-sans antialiased">
    <x-navigation />

    @yield('before-content')

    <div class="flex grow px-4 py-8 sm:px-6">
        <div id="content" class="container min-h-full mx-auto lg:max-w-3xl">
            @yield('content')
        </div>
    </div>

    @yield('after-content')

    <x-footer />
</div>
