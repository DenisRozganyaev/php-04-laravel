<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideNavLink extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $link,
        public string $name,
        public ?string $icon = null
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $isCurrent = request()->url() === $this->link;
        $iconClasses = $isCurrent
            ? 'bg-gradient-to-tl from-purple-700 to-pink-500 font-white'
            : '';
        $linkClasses = $isCurrent
            ? 'shadow-soft-xl bg-white'
            : '';

        return view('components.side-nav-link', compact('iconClasses', 'linkClasses'));
    }
}
