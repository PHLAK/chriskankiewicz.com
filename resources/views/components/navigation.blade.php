<div id="navigation" class="bg-gray-800 sticky top-0">
    <div class="flex flex-col justify-between mx-auto sm:container sm:flex-row">
        <div class="flex justify-between flex-grow">
            <a href="{{ route('home') }}" class="flex items-center font-montserrat whitespace-nowrap text-xl text-gray-100 tracking-wide p-4 hover:underline">
                Chris Kankiewicz
            </a>

            <div class="flex justify-between sm:hidden">
                <button class="text-white p-4 focus:outline-none hover:bg-gray-700" v-on:click="menuOpen = ! menuOpen">
                    <i class="fal fa-bars fa-fw" v-if="menuClosed"></i>
                    <i class="fal fa-times fa-fw" v-else v-cloak></i>
                </button>
            </div>
        </div>

        <ul class="w-full sm:flex sm:flex-row sm:w-auto" v-bind:class="menuStyles" v-cloak>
            <x-nav-item route="projects" section="projects" icon="fa-coffee" />
            <x-nav-item route="experience" section="experience" icon="fa-briefcase" />
            <x-nav-item route="education" section="education" icon="fa-graduation-cap" />
            <x-nav-item route="accomplishments" section="accomplishments" icon="fa-award" />
        </ul>
    </div>
</div>
