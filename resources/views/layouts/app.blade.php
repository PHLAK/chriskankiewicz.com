<!DOCTYPE html>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ mix('js/app.js') }}" defer></script>
<link rel="icon" href="{{ asset('favicon.png') }}">
<link rel="stylesheet" href="{{ mix('css/app.css') }}">

<title>{{ isset($title) ? sprintf('%s • ', $title) : null }}Chris Kankiewicz</title>

<div id="app" class="font-sans">
    @yield('content')
</div>
