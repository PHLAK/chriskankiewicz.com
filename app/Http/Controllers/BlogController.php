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
        // TODO: Paginate the posts...
        return view('blog.index', [
            'posts' => Post::with(['tags'])->orderBy('published_at', 'DESC')->get(),
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
        $post = Post::with(['tags'])->where('slug', $slug)->firstOrFail();

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
        $tag = Tag::with('posts')->where('slug', $slug)->firstOrFail();

        // TODO: Paginate the posts...
        return view('blog.index', [
            'posts' => $tag->posts,
            'title' => $tag->name,
        ]);
    }
}
