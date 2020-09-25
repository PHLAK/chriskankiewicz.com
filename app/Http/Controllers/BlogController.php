<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\View\View;

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
            'posts' => Post::with('tags')->orderBy('published_at', 'DESC')->simplePaginate(5),
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
        $post = Post::with('tags')->where('slug', $slug)->firstOrFail();

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
        $tag = Tag::where('slug', $slug)->firstOrFail();

        return view('blog.index', [
            'posts' => $tag->posts()->with('tags')->simplePaginate(5),
            'title' => $tag->name,
        ]);
    }
}
