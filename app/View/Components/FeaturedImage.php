<?php

namespace App\View\Components;

use App\Post;
use Illuminate\View\Component;

class FeaturedImage extends Component
{
    public Post $post;

    /** Create a new component instance. */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.featured-image');
    }
}
