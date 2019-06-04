@extends('layouts.app-sidebar')

@section('content')
    <div class="flex flex-col mb-16 xl:flex-row">
        <div class="xl:w-7/12 xl:mr-6">
            @heading(['tag' => 'h2'])
                <i class="far fa-lightbulb fw"></i> Skills
            @endheading

            <div class="flex flex-wrap mb-8">
                @foreach ($skills as $skill)
                    <span class="self-center inline-block bg-gray-200 px-2 py-1 m-1 rounded {{ $skill->textSize() }}">
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

    <div class="flex flex-col mb-16 xl:flex-row">
        <div class="xl:w-7/12 xl:mr-6">
            @heading(['tag' => 'h2'])
                <i class="far fa-briefcase fa-fw"></i> Experience
            @endheading

            @foreach ($experience as $experience)
                <div class="mb-8">
                    <h3 class="text-xl">
                        <span class="font-bold">
                            {{ $experience->title }}
                        </span>

                        @ {{ $experience->company }}
                    </h3>

                    <div class="text-sm text-gray-700">
                        {{ $experience->start_date->format('F Y') }} -
                        @if($experience->current_position)
                            Current
                        @else
                            {{ $experience->end_date->format('F Y') }}
                        @endif
                        &bull; {{ $experience->location }}
                    </div>

                    <p class="my-4">
                        {{ $experience->description }}
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

    <div class="flex flex-col mb-16 xl:flex-row">
        <div class="xl:w-7/12 xl:mr-6">
            @heading(['tag' => 'h2'])
                <i class="far fa-graduation-cap fa-fw"></i> Education
            @endheading

            @foreach ($education as $education)
                <div class="mb-8">
                    <h3 class="text-xl">
                        <span class="font-bold">
                            {{ $education->institution }}
                        </span>
                    </h3>

                    <div class="text-sm text-gray-700">
                        {{ $education->start_date->format('F Y') }}
                        - {{ $education->end_date->format('F Y') }}
                    </div>

                    <p class="my-4">
                        {{ $education->degree }}
                    </p>
                </div>
            @endforeach
        </div>

        <div class="xl:w-5/12">
            <http-request-component request-path="/api/education" title="Education">
                Educational history and achievements.
            </http-request-component>
        </div>
    </div>
@endsection
