<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class Icon extends Component
{
    public function __construct(
        public readonly string $name
    ) {
    }

    public function render(): ViewContract
    {
        return View::make(sprintf('icons.%s', $this->name));
    }
}
