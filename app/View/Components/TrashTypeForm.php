<?php

namespace App\View\Components;

use app\Application\UI\Query\UIQuery;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TrashTypeForm extends Component
{
    public array $currentQueries;
    public string $route;
    public ?string $selectedTrashType;

    private const EXCEPT_KEYS = ['trash_type'];

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $route,
        UIQuery $query,
    ) {
        $this->currentQueries = $query->except(self::EXCEPT_KEYS);
        $this->route = $route;
        $this->selectedTrashType = $query->trashType;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.trash-type-form');
    }
}
