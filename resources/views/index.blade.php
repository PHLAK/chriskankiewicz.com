@extends('layouts.app-sidebar')

@section('content')
    @include('components.navigation')

    <div class="p-6 lg:max-w-2xl">
        This is the home page...
    </div>

    @include('components.footer')
@endsection
