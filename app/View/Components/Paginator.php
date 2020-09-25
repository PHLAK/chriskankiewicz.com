<?php

namespace App\View\Components;

use Illuminate\Pagination\Paginator as IlluminatePaginator;
use Illuminate\View\Component;

class Paginator extends Component
{
    public IlluminatePaginator $paginator;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(IlluminatePaginator $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.paginator');
    }
}
