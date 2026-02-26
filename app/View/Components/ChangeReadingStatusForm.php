<?php

namespace App\View\Components;

use App\Domain\Book\ValueObject\BookReadingStatus;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ChangeReadingStatusForm extends Component
{
    public string $route;
    public int $bookId;
    public BookReadingStatus $selected;
    public array $statuses;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $route,
        int $bookId,
        BookReadingStatus $selected
    )
    {
        $this->route = $route;
        $this->bookId = $bookId;
        $this->selected = $this->judgeSelected($selected);
        $this->statuses = BookReadingStatus::cases();
    }
    
    /**
     * Selectedの判定
     *
     * @param  BookReadingStatus $selected
     * @return BookReadingStatus
     */
    private function judgeSelected(BookReadingStatus $selected): BookReadingStatus
    {
        $oldSelected = old('reading_status');

        return !is_null($oldSelected)
            ? BookReadingStatus::tryFrom($oldSelected) ?? $selected
            : $selected;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.change-reading-status-form');
    }
}
