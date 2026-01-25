<?php

namespace App\View\Components;

use App\Application\UI\DTO\SimplePaginateView;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SimplePagination extends Component
{
    public SimplePaginateView $paginateView;

    /**
     * Create a new component instance.
     */
    public function __construct(
        SimplePaginateView $paginateView,
    )
    {
        $this->paginateView = $paginateView;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.simple-pagination');
    }
}
