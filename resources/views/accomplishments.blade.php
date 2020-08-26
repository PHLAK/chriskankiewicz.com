@extends('layouts.app-sidebar')

@section('content')
    @include('components.navigation')

    <div class="p-6 lg:max-w-2xl">
        <div id="accomplishments" class="mb-12" {{-- v-show="activeSection == 'accomplishments'" --}}>
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
    </div>

    @include('components.footer')
@endsection
