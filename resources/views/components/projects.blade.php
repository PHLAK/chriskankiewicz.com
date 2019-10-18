<div id="projects" class="mb-12" v-show="activeSection == 'projects'">
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
                {!! markdown($project->description) !!}
            </p>

            <div class="flex flex-wrap items-center mb-8">
                @foreach ($project->skills as $skill)
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

    <http-request-component request-path="/api/project" title="Projects">
        Software and web projects.
    </http-request-component>
</div>
