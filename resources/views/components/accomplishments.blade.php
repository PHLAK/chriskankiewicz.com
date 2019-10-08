<div id="accomplishments" class="mb-24">
    @heading(['tag' => 'h2'])
        <i class="far fa-award fa-fw"></i> Accomplishments
    @endheading

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
