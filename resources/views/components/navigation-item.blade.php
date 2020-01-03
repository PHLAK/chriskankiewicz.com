<li class="flex-grow lg:flex-initial">
    <button
        class="inline-block rounded-none w-full border-t-4 border-gray-800 font-mono text-xs text-gray-400 text-center px-2 py-4 sm:text-sm lg:text-base lg:px-4 xl:px-6 focus:outline-none"
        v-on:click="navigateTo('{{ $section }}')" v-bind:class="ifActive('{{ $section }}')"
    >
        <i class="fal {{ $icon }} fa-fw fa-lg hidden xs:inline-block md:hidden lg:inline-block"></i> {{ ucfirst($section) }}
    </button>
</li>
