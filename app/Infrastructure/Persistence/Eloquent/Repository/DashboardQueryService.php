<?php

namespace App\Infrastructure\Persistence\Eloquent\Repository;

use App\Application\Book\DTO\ReadingBookDto;
use App\Application\Book\DTO\ReadingStatusCountsDto;
use App\Application\Category\DTO\ByCategoryBooksDto;
use App\Application\Dashboard\DTO\DashboardSummaryDto;
use App\Application\Dashboard\DTO\TrashSummaryDto;
use App\Application\Dashboard\Query\DashboardQuery;
use App\Application\Dashboard\Repository\DashboardQueryServiceInterface;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Collection;

class DashboardQueryService implements DashboardQueryServiceInterface
{
    /**
     * サマリーを取得
     *
     * @param  DashboardQuery $query
     * @return DashboardDto
     */
    public function getSummary(DashboardQuery $query): DashboardSummaryDto
    {
        // 読書状況サマリー
        $selectRaws = [
            "SUM(reading_status = 'unread' AND deleted_at IS NULL) as unread",
            "SUM(reading_status = 'reading' AND deleted_at IS NULL) as reading",
            "SUM(reading_status = 'completed' AND deleted_at IS NULL) as completed",
        ];

        $bookStats = Book::where('user_id', $query->userId)
            ->selectRaw(implode(',', $selectRaws))
            ->first();


        // 読書中の本
        $readingBooks = $this->getReadingBooks($query->userId, $query->showBookLimit);
        

        // カテゴリー別冊数
        $categoryStats = $this->getCategoryStats($query->userId);


        return new DashboardSummaryDto(
            new ReadingStatusCountsDto(
                (int)($bookStats->unread ?? 0),
                (int)($bookStats->reading ?? 0),
                (int)($bookStats->completed ?? 0)
            ),
            $readingBooks->map(fn($c) => new ReadingBookDto(
                $c->id,
                $c->title
            ))->all(),
            $categoryStats->map(fn($c) => new ByCategoryBooksDto(
                $c->id,
                $c->title,
                (int)$c->books_count
            ))->all(),
        );
    }
    
    /**
     * 削除済み件数を取得
     *
     * @return TrashSummaryDto
     */
    public function getTrashSummary(): TrashSummaryDto
    {
        return  new TrashSummaryDto(
            Book::onlyTrashed()->count(),
            Category::onlyTrashed()->count()
        );
    }
    
    /**
     * 読書中の本リストを取得
     *
     * @param  ?int $userId
     * @param  ?int $limit 取得件数の制限
     * @return Collection
     */
    private function getReadingBooks(?int $userId = null, ?int $limit = null): Collection
    {
        return Book::query()
            ->when(!is_null($userId), fn($q) => $q->where('user_id', $userId))
            ->where('reading_status', 'reading')
            ->withoutTrashed()
            ->orderBy('updated_at', 'desc')
            ->when(!is_null($limit), fn($q) => $q->limit($limit))
            ->get();
    }
    
    /**
     * カテゴリー別の冊数を取得
     * 
     * 以下はNULLとして取得する
     * ・カテゴリーが未設定
     * ・カテゴリーが論理削除済み
     *
     * @param  ?int $userId
     * @return Collection
     */
    private function getCategoryStats(?int $userId = null): Collection
    {
        return Book::query()
            ->leftJoin('categories', function ($join) {
                $join->on('categories.id', '=', 'books.category_id')
                    ->whereNull('categories.deleted_at');
            })
            ->whereNull('books.deleted_at')
            ->when(!is_null($userId), fn($q) => $q->where('books.user_id', $userId))
            ->selectRaw('
                categories.id as id,
                categories.title as title,
                COUNT(*) as books_count
            ')
            ->groupBy('categories.id', 'categories.title')
            ->orderByRaw('categories.id IS NULL ASC, categories.id ASC')
            ->get();
    }
}