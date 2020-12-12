@extends('layouts.app')

@section('content')
    <div class="flex content-center justify-center items-center min-h-full">
        <form method="POST" action="{{ route('login') }}" class="bg-white border-2 border-gray-800 shadow-solid-gray-800 m-4 p-6 w-full max-w-xl">
            @csrf

            <div class="mb-6">
                <label for="email" class="inline-block absolute bg-white text-xs text-gray-800 uppercase -m-2 ml-2 px-1">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" name="email" placeholder="Gordon.Freeman@BlackMesa.com" value="{{ old('email') }}" class="w-full border-2 border-gray-800 shadow-inner text-lg p-2 focus:shadow-inner {{ $errors->has('email') ? 'border-red' : null }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="text-red-700" role="alert">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>

            <div class="mb-6">
                <label for="password" class="inline-block absolute bg-white text-xs text-gray-800 uppercase -m-2 ml-2 px-1">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" placeholder="•••••••••••••••" class="w-full border-2 border-gray-800 shadow-inner text-lg p-2 focus:shadow-inner {{ $errors->has('password') ? 'border-red' : '' }}" required>

                @if ($errors->has('password'))
                    <span class="text-red-700" role="alert">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>

            <div class="flex flex-col justify-between items-center xs:flex-row xs:space-x-2">
                <div class="space-x-1 order-last pt-4 xs:order-first xs:pt-0">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : null }}>

                    <label for="remember" class="text-sm text-gray-600">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <div class="flex justify-between items-center w-full order-first xs:space-x-4 xs:order-last xs:w-auto">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-600 hover:underline" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif

                    <button type="submit" class="inline-block rounded bg-teal-600 text-white px-4 py-2 hover:bg-teal-700">
                        {{ __('Login') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
