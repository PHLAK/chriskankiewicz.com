<li class="flex-grow lg:flex-initial">
    <a href="{{ route($route) }}"
        class="inline-block rounded-none w-full border-t-4 border-gray-800 font-mono text-xs text-gray-400 text-center px-2 py-4 sm:text-sm lg:text-base lg:px-4 xl:px-6 focus:outline-none
        {{ $isActive() ? 'bg-white text-gray-800 border-teal-600' : 'active:bg-gray-700 hover:bg-gray-700 hover:border-gray-700' }}"
    >
        <i class="fal {{ $icon }} fa-fw fa-lg hidden xs:inline-block md:hidden lg:inline-block"></i> {{ ucfirst($section) }}
    </a>
</li>
