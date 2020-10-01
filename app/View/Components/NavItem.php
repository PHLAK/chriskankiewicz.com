<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class NavItem extends Component
{
    /** @var string */
    public $route;

    /** @var string */
    public $section;

    /** @var string */
    public $icon;

    /** Create a new component instance. */
    public function __construct(string $route, string $section, string $icon)
    {
        $this->route = $route;
        $this->section = $section;
        $this->icon = $icon;
    }

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
        return $this->route === Route::currentRouteName();
    }
}
