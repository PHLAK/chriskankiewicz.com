<div class="my-4">
    <img {{ $attributes }}
        src="{{ $post->featured_image_url }}"
        alt="{{ strip_tags(markdownInline($post->featured_image_text ?? '')) }}"
    >

    @if($withText && isset($post->featured_image_text))
        <div class="flex justify-center text-gray-600 text-sm mt-2">
            {!! markdownInline($post->featured_image_text) !!}
        </div>
    @endif
</div>
