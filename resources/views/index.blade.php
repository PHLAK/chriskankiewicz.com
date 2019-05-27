@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex">
            <div id="sidebar" class="flex-none w-5/12 max-w-3xl min-w-xl min-h-screen p-6 bg-gray-200">
                <div id="user-card" class="rounded-lg border-2 border-gray-800 shadow-solid-gray-800 w-full bg-white overflow-hidden">
                    <div class="h-40 bg-cover bg-center" style="background-image: url('{{ asset('images/user_bg.jpg') }}');"></div>

                    <img src="{{ asset('images/mustache_chris.jpg') }}" alt="Profile Photo" class="w-32 rounded-full border-white border-8 mx-4 -mt-16">

                    <h1 class="font-semibold text-2xl -mt-16 ml-32 px-4 py-2">
                        Chris Kankiewicz
                        <div class="font-light text-base text-gray-500">
                            <i class="far fa-map-marker-alt fa-fw"></i> Mesa, Arizona
                        </div>
                    </h1>

                    <p class="mb-4 px-4 py-2">
                        Passionate PHP developer, Linux junkie, gamer and coffee afficionado.
                    </p>

                    <div class="flex justify-around p-4 border-t-2 border-gray-800">
                        <a href="https://github.com/PHLAK" title="GitHub" class="text-github">
                            <i class="fab fa-github fa-fw fa-2x"></i>
                        </a>

                        <a href="#" title="Twitter" class="text-twitter">
                            <i class="fab fa-twitter fa-fw fa-2x"></i>
                        </a>

                        <a href="#" title="LinkedIn" class="text-linkedin">
                            <i class="fab fa-linkedin fa-fw fa-2x"></i>
                        </a>

                        <a href="#" title="Keybase" class="text-keybase">
                            <i class="fab fa-keybase fa-fw fa-2x"></i>
                        </a>

                        <a href="#" title="Steam" class="text-steam">
                            <i class="fab fa-steam fa-fw fa-2x"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div id="content" class="w-7/12 p-6">
                <h1 class="font-mono text-2xl mb-8">Main Content</h1>

                <http-request-component request-uri="/api/skill" title="Skills">
                    Skills and areas of expertise.
                </http-request-component>

                <http-request-component request-uri="/api/experience" title="Experience">
                    Work experience and job history.
                </http-request-component>

                <http-request-component request-uri="/api/education" title="Education">
                    Educational history and achievements.
                </http-request-component>
            </div>
        </div>
    </div>
@endsection
