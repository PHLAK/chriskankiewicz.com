@extends('layouts.app-with-nav')

@section('content')
    <div class="p-6 lg:max-w-2xl">
        <div id="education" class="mb-12">
            @foreach ($education as $education)
                <div class="mb-8">
                    <h3 class="text-2xl">
                        <span class="font-bold">
                            {{ $education->institution }}
                        </span>
                    </h3>

                    <div class="text-sm text-gray-600">
                        <i class="fal fa-calendar-day fa-fw"></i>
                        {{ $education->start_date->format('F Y') }}
                        - {{ optional($education->end_date)->format('F Y') ?? 'Current' }}
                    </div>

                    <div class="my-4">
                        {!! markdown($education->degree) !!}
                    </div>
                </div>

                @if(! $loop->last)
                    <hr class="border-t-4 border-teal-600 w-40 my-8">
                @endif
            @endforeach

            <http-request-component request-path="/api/education" title="Education">
                Educational history and achievements.
            </http-request-component>
        </div>
    </div>
@endsection
