@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row">
        <div class="flex-none md:min-h-screen">
            <x-sidebar />
        </div>

        <div class="flex flex-col flex-grow w-full min-h-full">
            <x-navigation />

            <div id="content" class="flex-grow w-full">
                @yield('content')
            </div>

            <x-footer />
        </div>
    </div>
@overwrite
