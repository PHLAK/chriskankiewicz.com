@extends('layouts.app')

@section('content')
    <div class="flex content-center justify-center items-center h-screen bg-gray-200">
        <form method="POST" action="{{ route('login') }}" class="bg-white border-2 border-gray-800 rounded shadow-solid-gray-800 m-4 p-6 w-full max-w-xl">
            @csrf

            <div class="mt-2 mb-6">
                <label for="email" class="inline-block absolute bg-white text-xs text-gray-800 uppercase -m-2 ml-2 px-1">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" name="email" placeholder="Gordon.Freeman@BlackMesa.com" value="{{ old('email') }}" class="w-full border-2 border-black shadow-inner rounded text-lg p-2 focus:shadow-inner {{ $errors->has('email') ? 'border-red' : null }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="text-red-700" role="alert">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>

            <div class="mt-2 mb-6">
                <label for="password" class="inline-block absolute bg-white text-xs text-gray-800 uppercase -m-2 ml-2 px-1">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" placeholder="•••••••••••••••" class="w-full border-2 border-black shadow-inner rounded text-lg p-2 focus:shadow-inner {{ $errors->has('password') ? 'border-red' : '' }}" required>

                @if ($errors->has('password'))
                    <span class="text-red-700" role="alert">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>

            <div class="flex flex-row justify-between">
                <div class="py-2 sm:block">
                    <input type="checkbox" name="remember" id="remember" class="relative top-2" {{ old('remember') ? 'checked' : null }}>

                    <label for="remember" class="text-sm text-gray-600">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <div class="sm:block">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-600 px-4 py-2" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif

                    <button type="submit" class="inline-block rounded bg-black text-white px-4 py-2 hover:bg-gray-800">
                        {{ __('Login') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
