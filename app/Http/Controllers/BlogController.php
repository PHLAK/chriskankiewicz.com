<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Wink;

class BlogController extends Controller
{
    /**
     * Display all blog posts.
     *
     * @return View
     */
    public function index(): View
    {
        return view('blog.index', [
            'posts' => Wink\WinkPost::with(['author', 'tags'])->get(),
        ]);
    }

    /**
     * Display a blog post.
     *
     * @param string $slug
     *
     * @return \Illuminate\View\View
     */
    public function post(string $slug): View
    {
        $post = Wink\WinkPost::with(['author', 'tags'])->where('slug', $slug)->firstOrFail();

        return view('blog.post', [
            'post' => $post,
            'title' => $post->title,
        ]);
    }

    /**
     * Display posts belonging to a specific tag.
     *
     * @return \Illuminate\View\View
     */
    public function tag(string $slug): View
    {
        $tag = Wink\WinkTag::with('posts')->where('slug', $slug)->firstOrFail();

        return view('blog.index', [
            'posts' => $tag->posts,
            'title' => $tag->name,
        ]);
    }
}
