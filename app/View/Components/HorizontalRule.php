<?php

namespace App\View\Components;

use Illuminate\View\Component;

class HorizontalRule extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.horizontal-rule');
    }
}
