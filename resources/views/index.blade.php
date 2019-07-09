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

    <div class="flex flex-col mb-16 xl:flex-row">
        <div class="xl:w-7/12 xl:mr-6">
            @heading(['tag' => 'h2'])
                <i class="far fa-graduation-cap fa-fw"></i> Education
            @endheading

            @foreach ($education as $education)
                <div class="mb-8">
                    <h3 class="text-2xl">
                        <span class="font-bold">
                            {{ $education->institution }}
                        </span>
                    </h3>

                    <div class="text-sm text-gray-600">
                        <i class="far fa-calendar-day fa-fw"></i>
                        {{ $education->start_date->format('F Y') }}
                        - {{ $education->end_date->format('F Y') }}
                    </div>

                    <p class="my-4">
                        {!! $education->degree !!}
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

    <div class="flex flex-col mb-16 xl:flex-row">
        <div class="xl:w-7/12 xl:mr-6">
            @heading(['tag' => 'h2'])
                <i class="far fa-coffee fa-fw"></i> Projects
            @endheading

            @foreach ($projects as $project)
                <div class="mb-8">
                    <h3 class="text-2xl">
                        <span class="font-bold">
                            {{ $project->name }}
                        </span>
                    </h3>

                    <div class="text-sm text-gray-600">
                        <a href="{{ $project->source_url }}" class="group inline-block mr-2">
                            <i class="fab fa-github fa-fw"></i>
                            <span class="group-hover:text-teal-700 group-hover:underline">
                                {{ $project->github_project_id }}
                            </span>
                        </a>

                        <span class="group inline-block mr-2">
                            <i class="far fa-star fa-fw"></i>

                            {{ $project->stars()}}
                        </span>

                        <span class="group inline-block mr-2">
                            <i class="far fa-code-branch fa-fw"></i>

                            {{ $project->forks() }}
                        </span>

                        @isset($project->project_url)
                            <a href="{{ $project->project_url }}" class="group inline-block">
                                <i class="far fa-globe-americas fa-fw"></i>
                                <span class="group-hover:text-teal-700 group-hover:underline">
                                    {{ $project->project_url }}
                                </span>
                            </a>
                        @endif
                    </div>

                    <p class="my-4">
                        {!! $project->description !!}
                    </p>

                    @isset($project->snippet)
                        <pre class="rounded-lg my-4 max-w-full overflow-x-scroll">
                            <code class="language-php">{{ $project->snippet }}</code>
                        </pre>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="xl:w-5/12">
            <http-request-component request-path="/api/project" title="Projects">
                Software and web projects.
            </http-request-component>
        </div>
    </div>
@endsection
