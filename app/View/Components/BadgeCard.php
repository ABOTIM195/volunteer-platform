<?php

namespace App\View\Components;

use App\Models\Badge;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BadgeCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Badge $badge,
        public bool $earned = false,
        public bool $featured = false,
        public ?string $earnedAt = null,
        public bool $showDetails = true
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.badge-card');
    }
}
