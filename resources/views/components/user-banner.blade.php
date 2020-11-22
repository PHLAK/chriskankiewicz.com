<div id="user-card" class="bg-gray-200 bg-cover bg-center mb-24 px-4 py-8 sm:mb-32 sm:px-6" style="background-image: url('{{ asset('images/user_bg_blurred.jpg') }}');">
    <div class="container mx-auto text-center">
        <div class="mb-8">
            <div class="inline-block shadow rounded-lg bg-gray-200 bg-opacity-75 space-y-4 text-gray-800 p-8 sm:text-xl md:text-2xl">
                <p>Passionate PHP developer, Linux junkie, gamer and coffee aficionado.</p>
                <p>Dedicated husband and father of two.</p>
            </div>
        </div>

        <div>
            <img src="{{ gravatar('Chris@ChrisKankiewicz.com', 300) }}" alt="Profile Photo" class="inline-block w-48 rounded-full border-white border-8 font-bold mx-auto -mb-32 sm:w-64 sm:-mb-40">
        </div>
    </div>
</div>
