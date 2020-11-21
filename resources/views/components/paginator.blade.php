@if($paginator->hasPages())
    <div class="flex justify-between border-t-2 border-gray-100 pt-6 mt-6">
        <div>
            @unless($paginator->onFirstPage())
                <a href="{{ $paginator->previousPageUrl() }}" class="inline-block border-r-4 border-transparent pr-2 hover:border-teal-600">
                    <i class="fal fa-long-arrow-left"></i> Previous
                </a>
            @endunless
        </div>

        <div>
            @if($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="inline-block border-l-4 border-transparent pl-2 hover:border-teal-600">
                    Next <i class="fal fa-long-arrow-right"></i>
                </a>
            @endif
        </div>
    </div>
@endif

