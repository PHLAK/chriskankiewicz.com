<div id="experience" class="mb-24">
    @heading(['tag' => 'h2'])
        <i class="far fa-briefcase fa-fw"></i> Experience
    @endheading

    @foreach ($experience as $experience)
        <div class="mb-8">
            <h3 class="text-2xl">
                <span class="font-bold">
                    {{ $experience->title }}
                </span>

                @ {{ $experience->company }}
            </h3>

            <div class="text-sm text-gray-600">
                <span class="mr-2">
                    <i class="far fa-calendar-day fa-fw"></i>
                    {{ $experience->start_date->format('F Y') }} -
                    @if($experience->current_position)
                        Current
                    @else
                        {{ $experience->end_date->format('F Y') }}
                    @endif
                </span>

                <span>
                    <i class="far fa-map-marker-alt fa-fw"></i>
                    {{ $experience->location }}
                </span>
            </div>

            <p class="my-4">
                {!! markdown($experience->description) !!}
            </p>

            <div class="flex flex-wrap items-center mb-8">
                @foreach ($experience->skills as $skill)
                    <span class="inline-block bg-gray-200 text-gray-800 px-2 py-1 m-1 rounded">
                        @if($skill->hasIcon())
                            {!! $skill->iconMarkup(['mr-1']) !!}
                        @endif

                        {{ $skill->name }}
                    </span>
                @endforeach
            </div>
        </div>

        @if(! $loop->last)
            <hr class="border-t-4 border-teal-600 w-40 my-8">
        @endif
    @endforeach

    <http-request-component request-path="/api/experience" title="Experience">
        Work experience and job history.
    </http-request-component>
</div>
