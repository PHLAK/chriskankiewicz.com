<div id="navigation" class="bg-gray-800 border-white fixed top-0 w-full sm:border-b-4 sm:sticky">
    <div class="flex justify-between sm:hidden">
        <a href="{{ route('home') }}" class="text-white p-4 focus:outline-none hover:bg-gray-700">
            <i class="fal fa-home fa-fw fa-lg"></i> Home
        </a>

        <button class="text-white p-4 focus:outline-none hover:bg-gray-700" v-on:click="menuOpen = ! menuOpen">
            <i class="fal fa-bars fa-fw" v-if="! menuOpen"></i>
            <i class="fal fa-times fa-fw" v-if="menuOpen"></i>
        </button>
    </div>

    <ul class="flex-col sm:flex sm:flex-row" v-bind:class="menuStyles">
        <x-nav-item route="home" section="home" icon="fa-home" class="hidden sm:flex" />
        <x-nav-item route="experience" section="experience" icon="fa-briefcase" />
        <x-nav-item route="projects" section="projects" icon="fa-coffee" />
        <x-nav-item route="education" section="education" icon="fa-graduation-cap" />
        <x-nav-item route="accomplishments" section="accomplishments" icon="fa-award" />
    </ul>
</div>
