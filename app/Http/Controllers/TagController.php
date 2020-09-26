<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\View\View;

class TagController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(string $slug): View
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        return view('blog.index', [
            'posts' => $tag->posts()->with('tags')->simplePaginate(5),
            'title' => $tag->name,
        ]);
    }
}
