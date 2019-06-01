<div id="sidebar" class="flex flex-col justify-between w-full p-6 bg-gray-200 h-full md:max-w-md">
    <div id="user-card" class="border-2 border-gray-800 shadow-solid-gray-800 bg-white overflow-hidden md:sticky md:top-6">
        <div class="h-40 bg-cover bg-center" style="background-image: url('{{ asset('images/user_bg.jpg') }}');"></div>

        <img src="{{ gravatar('Chris@ChrisKankiewicz.com', 300) }}" alt="Profile Photo" class="w-32 rounded-full border-white border-8 mx-4 -mt-16">

        <h1 class="font-semibold text-xl -mt-16 ml-32 px-4 py-2">
            Chris Kankiewicz

            <div class="font-light text-base text-gray-500">
                <i class="far fa-map-marker-alt fa-fw"></i> Mesa, Arizona
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

    <a href="https://github.com/PHLAK/chriskankiewicz.com" class="block bg-gray-800 text-white text-center p-4 mt-6 -mx-6 -mb-6 sticky bottom-0 hover:bg-gray-700">
        <i class="far fa-code fa-fw"></i> View source on GitHub
    </a>
</div>
