<ul class="flex items-end text-sm md:text-base">
    <li class="flex-grow lg:flex-initial">
        <button
            class="inline-block rounded-none w-full focus:outline-none font-mono text-xs text-gray-400 text-center px-2 py-4 sm:text-sm lg:text-base lg:px-4 xl:px-6"
            v-on:click="navigateTo('experience')" v-bind:class="ifActive('experience')"
        >
            <i class="fal fa-briefcase fa-fw fa-lg hidden xs:inline-block md:hidden lg:inline-block"></i> Experience
        </button>
    </li>

    <li class="flex-grow lg:flex-initial">
        <button
            class="inline-block rounded-none w-full focus:outline-none font-mono text-xs text-gray-400 text-center px-2 py-4 sm:text-sm lg:text-base lg:px-4 xl:px-6"
            v-on:click="navigateTo('projects')" v-bind:class="ifActive('projects')"
        >
            <i class="fal fa-coffee fa-fw fa-lg hidden xs:inline-block md:hidden lg:inline-block"></i> Projects
        </button>
    </li>

    <li class="flex-grow lg:flex-initial">
        <button
            class="inline-block rounded-none w-full focus:outline-none font-mono text-xs text-gray-400 text-center px-2 py-4 sm:text-sm lg:text-base lg:px-4 xl:px-6"
            v-on:click="navigateTo('education')" v-bind:class="ifActive('education')"
        >
            <i class="fal fa-graduation-cap fa-fw fa-lg hidden xs:inline-block md:hidden lg:inline-block"></i> Education
        </button>
    </li>

    <li class="flex-grow lg:flex-initial">
        <button
            class="inline-block rounded-none w-full focus:outline-none font-mono text-xs text-gray-400 text-center px-2 py-4 sm:text-sm lg:text-base lg:px-4 xl:px-6"
            v-on:click="navigateTo('accomplishments')" v-bind:class="ifActive('accomplishments')"
        >
            <i class="fal fa-award fa-fw fa-lg hidden xs:inline-block md:hidden lg:inline-block"></i> Accomplishments
        </button>
    </li>
</ul>
