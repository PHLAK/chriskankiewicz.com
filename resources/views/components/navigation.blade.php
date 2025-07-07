<div id="navigation" class="bg-slate-800 sticky top-0 z-50">
    <div class="flex flex-col justify-between mx-auto sm:container sm:flex-row">
        <div class="flex justify-between">
            <a href="{{ route('home') }}" class="flex items-center font-montserrat whitespace-nowrap text-xl text-slate-100 tracking-wide p-4 hover:underline">
                Chris Kankiewicz
            </a>

            <div class="flex justify-between sm:hidden">
                <button class="text-white p-4 cursor-pointer focus:outline-hidden hover:bg-slate-700" v-on:click="menuOpen = ! menuOpen">
                    <i class="fal fa-bars fa-fw" v-if="menuClosed"></i>
                    <i class="fal fa-times fa-fw" v-else v-cloak></i>
                </button>
            </div>
        </div>

        <ul class="w-full sm:flex sm:flex-row sm:w-auto" v-bind:class="{ 'flex-col': this.menuOpen, 'hidden': this.menuClosed }" v-cloak>
            <x-nav-item name="projects" icon="fa-coffee" />
            <x-nav-item name="experience" icon="fa-briefcase" />
            <x-nav-item name="education" icon="fa-graduation-cap" />
            <x-nav-item name="accomplishments" icon="fa-award" />
        </ul>
    </div>
</div>
