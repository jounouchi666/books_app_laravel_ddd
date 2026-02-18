<?php

namespace App\View\Components;

use App\Application\UI\Query\HasUserFilter;
use app\Application\UI\Query\UIQuery;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserCategoryForm extends Component
{
    public array $currentQueries;
    public string $route;
    public bool $allUsers;
    public ?int $selectedUserId;
    public array $users;

    private const EXCEPT_KEYS = ['all_users', 'user_id'];

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $route,
        UIQuery&HasUserFilter $query,
        array $users
    ) {
        $this->currentQueries = $query->except(self::EXCEPT_KEYS);
        $this->route = $route;
        $this->allUsers = $query->allUsers();
        $this->selectedUserId = $query->userId();
        $this->users = $users;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-category-form');
    }
}
