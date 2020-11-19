@extends('layouts.app')

@section('content')
    <div class="flex content-center justify-center items-center h-screen bg-gray-100">
        <form method="POST" action="{{ route('password.update') }}" class="bg-white border-2 border-gray-800 shadow-solid-gray-800 m-4 p-6 w-full max-w-xl">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-6">
                <label for="email" class="inline-block absolute bg-white text-xs text-gray-800 uppercase -m-2 ml-2 px-1">
                    {{ __('E-Mail Address') }}
                </label>

                <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" class="w-full border-2 border-gray-800 bg-white text-lg p-2 text-gray-500 {{ $errors->has('email') ? 'border-red' : null }}" readonly required>

                 @if ($errors->has('email'))
                    <span class="text-red-700" role="alert">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>

            <div class="mb-6">
                <label for="password" class="inline-block absolute bg-white text-xs text-gray-800 uppercase -m-2 ml-2 px-1">
                    {{ __('Password') }}
                </label>

                <input id="password" type="password" name="password" class="w-full border-2 border-gray-800 shadow-inner text-lg p-2 focus:shadow-inner {{ $errors->has('password') ? 'border-red' : null }}" required autofocus>

                @if ($errors->has('password'))
                    <span class="text-red-700" role="alert">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>

            <div class="mb-6">
                <label for="password-confirm" class="inline-block absolute bg-white text-xs text-gray-800 uppercase -m-2 ml-2 px-1">
                    {{ __('Confirm Password') }}
                </label>

                <input id="password-confirm" type="password" name="password_confirmation" class="w-full border-2 border-gray-800 shadow-inner text-lg p-2 focus:shadow-inner {{ $errors->has('password') ? 'border-red' : null }}" required>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="inline-block rounded bg-teal-600 text-white px-4 py-2 hover:bg-teal-700">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
    </div>
@endsection
