<div id="user-card" class="border-2 border-gray-800 shadow-solid-gray-800 bg-white overflow-hidden md:sticky md:top-6">
    <div class="h-40 bg-cover bg-center" style="background-image: url('{{ asset('images/user_bg.jpg') }}');"></div>

    <img src="{{ gravatar('Chris@ChrisKankiewicz.com', 300) }}" alt="Profile Photo" class="w-32 rounded-full border-white border-8 mx-4 -mt-16">

    <h1 class="font-semibold text-xl -mt-16 ml-32 px-4 py-2">
        Chris Kankiewicz

        <div class="font-light text-base text-gray-500">
            <i class="far fa-map-marker-alt fa-fw"></i>

            <a href="https://goo.gl/maps/Y5xrX7AQ9RUNpCKo8" class="hover:underline">Mesa, Arizona</a>
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
