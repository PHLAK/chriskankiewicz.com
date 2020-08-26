<div class="text-sm text-gray-600 mt-1">
    <span class="mr-2" title="{{ $post->publish_date->toDayDateTimeString() }}">
        <i class="fal fa-calendar-day fa-fw"></i>

        {{ $post->publish_date->format('F jS, Y') }}
    </span>

    @if($post->tags->isNotEmpty())
        <span>
            <i class="fal fa-tags fa-fw"></i>

            @foreach ($post->tags->sortBy('name') as $tag)
                <a href="{{ route('tag', $tag->slug) }}" class="inline-block hover:underline">
                    {{ $tag->name }}
                </a>

                @if(! $loop->last)<span>,</span>@endif
            @endforeach
        </span>
    @endif
</div>
