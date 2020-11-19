@extends('layouts.app')

@section('content')
    <div class="flex flex-col content-center justify-center items-center h-screen bg-gray-100">
        <form method="POST" action="{{ route('password.email') }}" class="bg-white border-2 border-gray-800 shadow-solid-gray-800 m-4 p-6 w-full max-w-xl">
            @csrf

            <div class="mb-6">
                <label for="email" class="inline-block absolute bg-white text-xs text-gray-800 uppercase -m-2 ml-2 px-1">
                    {{ __('E-Mail Address') }}
                </label>

                <input id="email" type="email"  name="email" value="{{ old('email') }}" class="w-full border-2 border-gray-800 shadow-inner text-lg p-2 focus:shadow-inner {{ $errors->has('email') ? 'border-red' : null }}" required>

                @if ($errors->has('email'))
                    <span class="text-red-700" role="alert">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>

            <div class="flex justify-end">
                <button type="submit" class="inline-block rounded bg-teal-600 text-white px-4 py-2 hover:bg-teal-700">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </form>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
@endsection
