<div class="flex flex-col mb-16 xl:flex-row">
    <div class="xl:w-7/12 xl:mr-6">
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
                    {!! $experience->description !!}
                </p>
            </div>
        @endforeach
    </div>

    <div class="xl:w-5/12">
        <http-request-component request-path="/api/experience" title="Experience">
            Work experience and job history.
        </http-request-component>
    </div>
</div>
