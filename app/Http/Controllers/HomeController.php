<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\View\View;

class HomeController extends Controller
{
    /** Handle the incoming request. */
    public function __invoke(): View
    {
        return view('blog.index', [
            'posts' => Post::with('tags')->simplePaginate(5),
        ]);
    }
}
