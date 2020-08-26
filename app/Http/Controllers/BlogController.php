<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Wink\WinkPost;

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
            'posts' => WinkPost::with(['author', 'tags'])->get(),
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
        return view('blog.post', [
            'post' => WinkPost::with(['author', 'tags'])->where('slug', $slug)->firstOrFail(),
        ]);
    }
}
