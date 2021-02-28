<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    /** Handle the incoming request. */
    public function __invoke(string $slug): View
    {
        $post = Post::with('tags')->where('slug', $slug)->firstOrFail();

        return view('blog.post', [
            'post' => $post,
            'title' => $post->title,
            'next' => Post::where('published_at', '>', $post->published_at)->orderBy('published_at', 'asc')->first(),
            'previous' => Post::where('published_at', '<', $post->published_at)->orderBy('published_at', 'desc')->first(),
        ]);
    }
}
