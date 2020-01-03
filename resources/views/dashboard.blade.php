@extends('layouts.app')

@section('content')
    <div class="flex content-center justify-center items-center h-screen bg-gray-200">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="text-center">
            @csrf

            <h1 class="text-2xl pb-4">You are logged in!</h1>

            <div class="pb-4">
                <a href="{{ route('index') }}" class="hover:underline">Home</a>
                &bull; <a href="{{ route('blog.index') }}" class="hover:underline">Blog</a>
                &bull; <a href="{{ route('telescope') }}" class="hover:underline">Telescope</a>
                &bull; <a href="{{ route('nova.login') }}" class="hover:underline">Nova</a>
            </div>

            <button type="submit" class="absolute top-0 right-0 rounded bg-teal-600 text-white px-4 py-2 m-4 hover:shadow-md">
                Logout
            </button>
        </form>
    </div>
@endsection
