@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row">
        <div class="flex-none md:min-h-screen">
            @include('components/sidebar')
        </div>

        <div id="content" class="flex-grow w-full">
            @yield('content')
        </div>
    </div>
@overwrite
