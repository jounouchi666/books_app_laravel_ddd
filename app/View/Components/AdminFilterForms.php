<?php

namespace App\View\Components;

use app\Application\UI\Query\UIQuery;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminFilterForms extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $route,
        public UIQuery $query,
        public array $users
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-filter-forms');
    }
}
