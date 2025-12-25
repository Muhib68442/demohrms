<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AnchorButton extends Component
{
    public string $href;
    public string $variant;

    public function __construct(string $href, string $variant = 'primary')
    {
        $this->href = $href;
        $this->variant = $variant;
    }

    public function render(): View|Closure|string
    {
        return view('components.anchor_button');
    }
}