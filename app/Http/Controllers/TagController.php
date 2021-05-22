<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\View\View;

class TagController extends Controller
{
    /** Handle the incoming request. */
    public function __invoke(Tag $tag): View
    {
        return view('blog.index', [
            'posts' => $tag->posts()->with('tags')->simplePaginate(5),
            'title' => $tag->name,
        ]);
    }
}
