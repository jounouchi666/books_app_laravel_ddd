<?php

namespace App\View\Components;

use App\Application\UI\DTO\PaginateView;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Pagination extends Component
{
    public PaginateView $paginateView;
    public int $displayRange;
    public int $displayPerTotalStart;
    public int $displayPerTotalEnd;

    /**
     * Create a new component instance.
     */
    public function __construct(
        PaginateView $paginateView,
        ?int $displayRange = null
    ) {
        $this->paginateView = $paginateView;
        $this->displayRange = $displayRange ?? 5;
        $this->displayPerTotalStart = $this->calcDisplayPerTotalStart();
        $this->displayPerTotalEnd = $this->calcDisplayPerTotalEnd();
    }
    
    /**
     * ページリストを生成
     * ページ数は$displayRangeで指定
     *
     * @return array
     */
    public function pages(): array
    {
        $current = $this->paginateView->currentPage;
        $last = $this->paginateView->lastPage;
        $range = $this->displayRange;

        if ($last <= 1) return [];

        $half = intdiv($range, 2);

        $start = $current - $half;
        $end = $current + $half;

        // 先頭側補正
        if ($start < 1) {
            $start = 1;
            $end = min($range, $last);
        }

        // 末尾側補正
        if ($end > $last) {
            $end = $last;
            $start = max(1, $last - $range + 1);
        }

        $pages = [];
        for ($i = $start; $i <= $end; $i++) {
            $pages[] = [
                'page' => $i,
                'isCurrent' => $i === $current,
            ];
        }

        return $pages;
    }

    /**
     * 表示範囲の件数の開始値を計算
     *
     * @return int
     */
    private function calcDisplayPerTotalStart(): int
    {
        $current = $this->paginateView->currentPage;
        $perPage = $this->paginateView->perPage;
        $total = $this->paginateView->total;

        if ($total === 0) return 0;

        return ($current - 1) * $perPage + 1;
    }
    
    /**
     * 表示範囲の件数の終了値を計算
     *
     * @return int
     */
    private function calcDisplayPerTotalEnd(): int
    {
        $current = $this->paginateView->currentPage;
        $perPage = $this->paginateView->perPage;
        $total = $this->paginateView->total;

        return min($current * $perPage, $total);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pagination');
    }
}
