<div class="my-4">
    <img src="{{ $post->featured_image }}" alt="{{ strip_tags(markdownInline($post->featured_image_text ?? '')) }}" class="border-2 border-gray-800 shadow-solid-gray-800 max-w-full">

    @isset($post->featured_image_text)
        <div class="flex justify-center text-gray-600 text-sm mt-2">
            {!! markdownInline($post->featured_image_text) !!}
        </div>
    @endisset
</div>
