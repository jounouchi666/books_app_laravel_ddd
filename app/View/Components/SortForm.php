<?php

namespace App\View\Components;

use App\Application\Shared\Enum\SortDirection;
use App\Application\UI\Query\UIQuery;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SortForm extends Component
{
    public string $id;
    public array $currentQueries;
    public string $route;
    public array $sorts;
    public string $sortSelected;
    public SortDirection $directionSelected;

    private const EXCEPT_KEYS = ['sort', 'direction'];

    private const ID_DEFAULT = 'sort-form';
    private const SORTS_DEFAULT =  ['created_at' => '作成日'];
    private const DIRECTION_SELECTED_DEFAULT = SortDirection::Desc;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $route,
        UIQuery $query,
        array $sorts = self::SORTS_DEFAULT,
        string $id = self::ID_DEFAULT
    )
    {
        $this->id = $id;
        $this->currentQueries = $query->except(self::EXCEPT_KEYS);
        $this->route = $route;
        $this->sorts = $sorts;
        $this->sortSelected = $this->judgeSortSelected($query);
        $this->directionSelected = $this->judgeDirectionSelected($query);
    }

    /**
     * SortSelectedの判定
     * 入力値、クエリパラメータが無ければデフォルト値を返す
     *
     * @param  UIQuery $query
     * @return string
     */
    private function judgeSortSelected(UIQuery $query): string
    {
        $oldSort = old('sort');

        if (!is_null($oldSort) && array_key_exists($oldSort, $this->sorts)) {
            return $oldSort;
        }

        $querySort = $query->sort;

        return array_key_exists($querySort, $this->sorts)
            ? $querySort
            : array_key_first($this->sorts);
    }

    /**
     * DirectionSelectedの判定
     * 入力値、クエリパラメータが無ければデフォルト値を返す
     *
     * @param  UIQuery $query
     * @return SortDirection
     */
    private function judgeDirectionSelected(UIQuery $query): SortDirection
    {
        $oldDirection = old('direction');

        if (!is_null($oldDirection)) {
            return SortDirection::tryFrom($oldDirection)
                ?? self::DIRECTION_SELECTED_DEFAULT;
        }

        return $query->direction
            ?? self::DIRECTION_SELECTED_DEFAULT;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sort-form');
    }
}
