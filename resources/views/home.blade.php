@extends('layouts.app')

@section('content')
    <div class="flex content-center justify-center items-center h-screen bg-gray-200">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="text-center">
            {{ csrf_field() }}

            <h1 class="text-2xl pb-4">You are logged in!</h1>

            <div class="pb-4">
                <a href="{{ route('index') }}">Home</a>
                &bull; <a href="{{ route('wink.pages.index') }}">Blog</a>
                &bull; <a href="{{ route('telescope') }}">Telescope</a>
                &bull; <a href="{{ route('nova.login') }}">Nova</a>
            </div>

            <button type="submit" class="rounded bg-teal-600 text-white px-4 py-2">Logout</button>
        </form>
    </div>
@endsection
