<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    /** Handle the incoming request. */
    public function __invoke(Post $post): View
    {
        return view('blog.post', [
            'post' => $post,
            'title' => $post->title,
            'newer' => Post::publishedAfter($post->published_at)->orderBy('published_at', 'asc')->first(),
            'older' => Post::publishedBefore($post->published_at)->orderBy('published_at', 'desc')->first(),
        ]);
    }
}
