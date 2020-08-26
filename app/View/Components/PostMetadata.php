<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Wink\WinkPost;

class PostMetadata extends Component
{
    public $post;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(WinkPost $post)
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
        return view('components.post-metadata');
    }
}
