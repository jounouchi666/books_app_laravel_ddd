<?php

namespace App\View\Components;

use App\Application\UI\Query\HasReadingStatus;
use app\Application\UI\Query\UIQuery;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReadingStatusForm extends Component
{
    public array $currentQueries;
    public string $route;
    public ?string $selectedReadingStatus;

    private const EXCEPT_KEYS = ['reading_status'];

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $route,
        UIQuery|HasReadingStatus $query,
    )
    {
        $this->currentQueries = $query->except(self::EXCEPT_KEYS);
        $this->route = $route;
        $this->selectedReadingStatus = $query->readingStatus();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.reading-status-form');
    }
}
