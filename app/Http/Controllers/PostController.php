<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(string $slug): View
    {
        $post = Post::with('tags')->where('slug', $slug)->firstOrFail();

        return view('blog.post', [
            'post' => $post,
            'title' => $post->title,
        ]);
    }
}
