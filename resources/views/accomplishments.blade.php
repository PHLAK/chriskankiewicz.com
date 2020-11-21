@extends('layouts.app')

@section('content')
    <div id="accomplishments">
        <ul class="list-disc list-inside mb-8">
            @foreach ($accomplishments as $accomplishment)
                <li class="text-lg mb-2">
                    {!! markdownInline($accomplishment->description) !!}
                </li>
            @endforeach
        </ul>

        <http-request-component request-path="/api/accomplishment" title="Accomplishments">
            Miscellaneous accomplishments.
        </http-request-component>
    </div>
@endsection
