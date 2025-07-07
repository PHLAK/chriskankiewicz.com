<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class NavItem extends Component
{
    public function __construct(
        public string $name,
        public string $icon
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.nav-item');
    }

    /** Determine if this navigation item is active. */
    public function isActive(): bool
    {
        return $this->name === Route::currentRouteName();
    }
}
