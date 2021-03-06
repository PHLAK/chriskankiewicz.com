@extends('layouts.app')

@section('content')
    <div id="education">
        @foreach ($education as $education)
            <div class="mb-8">
                <h3 class="font-lato font-bold text-2xl md:text-3xl">
                    {{ $education->institution }}
                </h3>

                <div class="text-sm text-gray-600 mt-1">
                    <i class="fal fa-calendar-day fa-fw"></i>
                    {{ $education->start_date->format('F Y') }}
                    - {{ optional($education->end_date)->format('F Y') ?? 'Current' }}
                </div>

                <div class="my-4">
                    {!! markdown($education->degree) !!}
                </div>
            </div>

            @if(! $loop->last)
                <x-horizontal-rule />
            @endif
        @endforeach

        <http-request-component request-path="/api/education" title="Education">
            Educational history and achievements.
        </http-request-component>
    </div>
@endsection
