@extends('layouts.app')

@section('content')
    <div id="projects">
        @foreach ($projects as $project)
            <div class="mb-8">
                <h3 class="font-lato font-bold text-2xl md:text-3xl">
                    {{ $project->name }}
                </h3>

                <div class="text-sm text-gray-600 mt-1">
                    <a href="{{ $project->source_url }}" class="group inline-block mr-2">
                        <i class="fab fa-github fa-fw"></i>
                        <span class="group-hover:text-teal-700 group-hover:underline">
                            {{ $project->github_project_id }}
                        </span>
                    </a>

                    <span class="group inline-block mr-2">
                        <i class="fal fa-star fa-fw"></i>

                        {{ $project->stars()}}
                    </span>

                    <span class="group inline-block mr-2">
                        <i class="fal fa-code-branch fa-fw"></i>

                        {{ $project->forks() }}
                    </span>

                    @isset($project->project_url)
                        <a href="{{ $project->project_url }}" class="group inline-block">
                            <i class="fal fa-globe-americas fa-fw"></i>
                            <span class="group-hover:text-teal-700 group-hover:underline">
                                {{ $project->project_url }}
                            </span>
                        </a>
                    @endif
                </div>

                <div class="my-4">
                    {!! markdown($project->description) !!}
                </div>

                <div class="flex flex-wrap items-center mb-8">
                    @foreach ($project->skills as $skill)
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

        <http-request-component request-path="/api/project" title="Projects">
            Software and web projects.
        </http-request-component>
    </div>
@endsection
