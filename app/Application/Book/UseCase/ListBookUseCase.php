<?php

namespace App\Application\Book\UseCase;

use App\Application\Auth\CurrentUserProvider;
use App\Application\Book\Assembler\BookViewAssembler;
use App\Application\Book\DTO\BookListView;
use App\Application\Book\DTO\BookUIQuery;
use App\Application\Book\Query\ListBookQuery;
use App\Application\Book\Repository\BookSearchRepositoryInterface;
use App\Application\Book\Service\BookAuthorizationService;
use App\Application\UI\DTO\PaginateView;
use App\Application\UI\PaginationUrlGeneratorFactory;
use App\Domain\User\Entity\User;

/**
 * ユースケース
 * Book一覧取得
 */
class ListBookUseCase
{
    public function __construct(
        private BookAuthorizationService $bookAutorizationService,
        private BookSearchRepositoryInterface $bookRepository,
        private BookViewAssembler $bookViewAssembler,
        private CurrentUserProvider $currentUserProvider,
        private PaginationUrlGeneratorFactory $paginationUrlGeneratorFactory
    ) {}
    
    /**
     * 実行
     *
     * @param  ListBookQuery $query
     * @return BookListView
     */
    function execute(ListBookQuery $query): BookListView
    {
        $currentUser = $this->currentUserProvider->currentUser();
        $isAdmin = $currentUser->isAdmin();

        // クエリ再構築
        $secureQuery = new ListBookQuery(
            $this->resolveUserId($query, $currentUser),
            $this->resolveAllUser($query, $currentUser),
            $query->categoryId,
            $query->sort,
            $query->direction,
            $this->resolveTrashType($query, $currentUser),
            $query->page,
            $query->perPage
        );

        $result = $this->bookRepository->search($secureQuery);

        $bookViews = $this->bookViewAssembler->buildViewsFromRecords(
            $result->records,
            $currentUser
        );

        // URL用パラメータ
        $bookUIQuery = new BookUIQuery(
            $isAdmin ? $query->userId : null,
            $isAdmin ? $query->allUser : null,
            $query->sort,
            $query->direction,
            $isAdmin ? $query->trashType : null
        );

        // ページネーション
        $paginateView = new PaginateView(
            $result->currentPage,
            $result->lastPage,
            $result->perPage,
            $result->total,
            $result->onFirstPage,
            $result->onLastPage,
            $this->paginationUrlGeneratorFactory->create(
                $bookUIQuery->toQueryArray(),
                $result->currentPage,
                $result->lastPage
            )
        );
        
        return new BookListView(
            $bookViews,
            $this->bookAutorizationService->canCreate($currentUser),
            $paginateView,
            $bookUIQuery
        );
    }
    
    /**
     * ユーザーIDの強制割り当て
     * 管理者ユーザー：allUserがtrueならNull、そうでなければそのまま
     * 一般ユーザー：ログインユーザー
     *
     * @param  ListBookQuery $query
     * @param  User $currentUser
     * @return int ユーザーID
     */
    private function resolveUserId(ListBookQuery $query, User $currentUser): ?int
    {
        // 一般ユーザー
        if (!$currentUser->isAdmin()) {
            return $currentUser->id()->value();
        }

        // 管理者
        if ($query->allUser === true) {
            return null;
        }

        if (!is_null($query->userId)) {
            return $query->userId;
        }

        return $currentUser->id()->value();
    }

    /**
     * AllUserの強制割り当て
     * 管理者ユーザー：そのまま（デフォルトはfalse）
     * 一般ユーザー：false固定
     *
     * @param  ListBookQuery $query
     * @param  User $currentUser
     * @return string
     */
    private function resolveAllUser(ListBookQuery $query, User $currentUser): bool
    {
        if (!$currentUser->isAdmin()) {
            return false;
        }

        return $query->allUser ?? false;
    }
    
    /**
     * TrashTypeの強制割り当て
     * 管理者ユーザー：そのまま（デフォルトはactive）
     * 一般ユーザー：active固定
     *
     * @param  ListBookQuery $query
     * @param  User $currentUser
     * @return string
     */
    private function resolveTrashType(ListBookQuery $query, User $currentUser): string
    {
        if (!$currentUser->isAdmin()) {
            return 'active';
        }

        return $query->trashType ?? 'active';
    }
}