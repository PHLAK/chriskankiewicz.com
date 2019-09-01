<div id="skills" class="flex flex-col mb-24 xl:flex-row">
    <div class="xl:w-7/12 xl:mr-6">
        @heading(['tag' => 'h2'])
            <i class="far fa-lightbulb fw"></i> Skills
        @endheading

        <div class="flex flex-wrap items-center mb-8">
            @foreach ($skills as $skill)
                <span class="inline-block bg-gray-200 px-2 py-1 m-1 rounded {{ $skill->styles() }}">
                    @isset($skill->icon)
                        <i class="{{ strtolower($skill->icon) }} mr-1"></i>
                    @endisset

                    {{ $skill->name }}
                </span>
            @endforeach
        </div>
    </div>

    <div class="xl:w-5/12">
        <http-request-component request-path="/api/skill" title="Skills">
            Skills and areas of expertise.
        </http-request-component>
    </div>
</div>
