@extends('layouts.app-sidebar')

@section('content')
    <div class="bg-gray-800 border-b-4 border-white sticky top-0">
        <ul class="flex items-end text-sm md:text-base">
            <li class="flex-grow lg:flex-initial">
                <button
                    class="inline-block w-full focus:outline-none font-mono text-gray-400 text-center px-2 py-4 lg:px-4 xl:px-6"
                    v-on:click="activeSection = 'experience'"
                    v-bind:class="ifActive('experience')"
                >
                    <i class="fal fa-briefcase fa-fw fa-lg hidden sm:inline-block md:hidden lg:inline-block"></i> Experience
                </button>
            </li>

            <li class="flex-grow lg:flex-initial">
                <button
                    class="inline-block w-full focus:outline-none font-mono text-gray-400 text-center px-2 py-4 lg:px-4 xl:px-6"
                    v-on:click="activeSection = 'education'"
                    v-bind:class="ifActive('education')"
                >
                    <i class="fal fa-graduation-cap fa-fw fa-lg hidden sm:inline-block md:hidden lg:inline-block"></i> Education
                </button>
            </li>

            <li class="flex-grow lg:flex-initial">
                <button
                    class="inline-block w-full focus:outline-none font-mono text-gray-400 text-center px-2 py-4 lg:px-4 xl:px-6"
                    v-on:click="activeSection = 'projects'"
                    v-bind:class="ifActive('projects')"
                >
                    <i class="fal fa-coffee fa-fw fa-lg hidden sm:inline-block md:hidden lg:inline-block"></i> Projects
                </button>
            </li>

            <li class="flex-grow lg:flex-initial">
                <button
                    class="inline-block w-full focus:outline-none font-mono text-gray-400 text-center px-2 py-4 lg:px-4 xl:px-6"
                    v-on:click="activeSection = 'accomplishments'"
                    v-bind:class="ifActive('accomplishments')"
                >
                    <i class="fal fa-award fa-fw fa-lg hidden sm:inline-block md:hidden lg:inline-block"></i> Accomplishments
                </button>
            </li>
        </ul>
    </div>

    <div class="p-6 lg:max-w-3xl">
        @include('components.experience')
        @include('components.education')
        @include('components.projects')
        @include('components.accomplishments')
    </div>

    <footer class="bg-gray-200 text-center text-gray-600 p-4">
        &copy; {{ date('Y') }} Chris Kankiewicz

        <span class="mx-1">
            &bull;
        </span>

        <a href="https://github.com/PHLAK/chriskankiewicz.com" class="underline">
            View source on GitHub
        </a>
    </footer>
@endsection
