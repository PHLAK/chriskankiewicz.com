@extends('layouts.app')

@section('before-content')
    <x-user-banner />
@endsection

@section('content')
    @yield('content')
@endsection
