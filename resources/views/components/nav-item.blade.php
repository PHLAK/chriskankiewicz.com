<li {{ $attributes->merge(['class' => 'flex-grow lg:flex-initial']) }}>
    <a href="{{ route($route) }}"
        class="flex justify-center items-center h-full border-l-4 border-transparent
            font-mono text-gray-300 uppercase py-4 pr-1
            sm:text-sm sm:px-2 sm:pt-1 sm:pb-0 sm:border-l-0 sm:border-b-4
            lg:text-base lg:px-4 hover:bg-gray-700 focus:outline-none
            {{ $isActive() ? 'border-teal-600' : null }}"
    >
        <i class="fal {{ $icon }} fa-fw fa-lg inline-block mr-2 sm:hidden md:inline-block"></i> {{ ucfirst($section) }}
    </a>
</li>
