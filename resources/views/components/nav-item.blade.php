<li {{ $attributes->merge(['class' => 'flex-grow lg:flex-initial']) }}>
    <a href="{{ route($route) }}"
        class="block w-full border-l-4 border-gray-800 font-mono text-gray-300 text-center p-4 sm:border-t-4 sm:border-l-0 xl:px-6 focus:outline-none
        {{ $isActive() ? 'bg-white text-gray-800 border-teal-600' : 'active:bg-gray-700 hover:bg-gray-700 hover:border-gray-700' }}"
    >
        <i class="fal {{ $icon }} fa-fw fa-lg inline-block"></i> {{ ucfirst($section) }}
    </a>
</li>
