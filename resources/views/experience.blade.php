@extends('layouts.app')

@section('content')
    <div id="experience">
        @foreach ($experience as $experience)
            <div class="mb-8">
                <h3 class="flex flex-wrap items-center">
                    <span class="font-lato font-bold text-2xl md:text-3xl mr-1">
                        {{ $experience->title }}
                    </span>

                    <span class="text-gray-800 text-lg md:text-xl">
                        @ {{ $experience->company }}
                    </span>
                </h3>

                <div class="text-sm text-gray-600 mt-1">
                    <span class="mr-2">
                        <i class="fal fa-calendar-day fa-fw"></i>
                        {{ $experience->start_date->format('F Y') }} -
                        {{ optional($experience->end_date)->format('F Y') ?? 'Current' }}
                    </span>

                    <span>
                        <i class="fal fa-map-marker-alt fa-fw"></i>
                        {{ $experience->location }}
                    </span>
                </div>

                <div class="my-4">
                    {!! markdown($experience->description) !!}
                </div>

                <div class="flex flex-wrap items-center mb-8">
                    @foreach ($experience->skills as $skill)
                        <span class="inline-block bg-gray-100 text-gray-800 px-2 py-1 m-1 rounded">
                            @if($skill->hasIcon())
                                {!! $skill->iconMarkup(['mr-1']) !!}
                            @endif

                            {{ $skill->name }}
                        </span>
                    @endforeach
                </div>
            </div>

            @if(! $loop->last)
                <x-horizontal-rule />
            @endif
        @endforeach

        <http-request-component request-path="/api/experience" title="Experience">
            Work experience and job history.
        </http-request-component>
    </div>
@endsection
