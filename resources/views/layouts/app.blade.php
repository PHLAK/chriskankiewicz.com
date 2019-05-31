<!DOCTYPE html>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('js/app.js') }}" defer></script>
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<title>Chris Kankiewicz</title>

<div id="app">
    <div class="flex flex-col md:flex-row">
        <div class="md:min-h-screen">
            @include('components/sidebar')
        </div>

        <div id="content" class="w-full p-6">
            @yield('content')
        </div>
    </div>
</div>
