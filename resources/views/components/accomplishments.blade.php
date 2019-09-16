<div id="accomplishments" class="flex flex-col mb-24 xl:flex-row">
    <div class="xl:w-7/12 xl:mr-6">
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
    </div>

    <div class="xl:w-5/12">
        <http-request-component request-path="/api/accomplishment" title="Accomplishments">
            Miscellaneous accomplishments.
        </http-request-component>
    </div>
</div>