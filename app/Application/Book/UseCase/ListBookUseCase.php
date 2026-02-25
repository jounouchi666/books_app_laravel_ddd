<?php

namespace App\Application\Book\UseCase;

use App\Application\Auth\CurrentUserProvider;
use App\Application\Book\Assembler\BookViewAssembler;
use App\Application\Book\DTO\BookListView;
use App\Application\Book\DTO\BookUIQuery;
use App\Application\Book\Query\ListBookQuery;
use App\Application\Book\Repository\BookSearchRepositoryInterface;
use App\Application\Book\Service\BookAuthorizationService;
use App\Application\Shared\Enum\TrashType;
use App\Application\UI\DTO\PaginateView;
use App\Application\UI\PaginationUrlGeneratorFactory;
use App\Application\User\Assembler\UserViewAssembler;
use App\Application\User\Repository\UserRepositoryInterface;
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
        private UserRepositoryInterface $userRepository,
        private BookViewAssembler $bookViewAssembler,
        private UserViewAssembler $userViewAssembler,
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
            $this->resolveAllUsers($query, $currentUser),
            $query->categoryId,
            $query->readingStatus,
            $query->sort,
            $query->direction,
            $this->resolveTrashType($query, $currentUser),
            $query->page,
            $query->perPage
        );

        // 取得
        $result = $this->bookRepository->search($secureQuery);

        $bookViews = $this->bookViewAssembler->buildViewsFromRecords(
            $result->records,
            $currentUser
        );

        $users = $isAdmin
            ? $this->userViewAssembler->buildViewsFromRecords($this->userRepository->getList())
            : [];

        // URL用パラメータ
        $bookUIQuery = BookUIQuery::fromQuery($secureQuery, $isAdmin);

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
            $users,
            $paginateView,
            $bookUIQuery
        );
    }
    
    /**
     * ユーザーIDの強制割り当て
     * 管理者ユーザー：allUsersがtrueならNull、そうでなければそのまま
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
        if ($query->allUsers) {
            return null;
        }

        if (!is_null($query->userId)) {
            return $query->userId;
        }

        return $currentUser->id()->value();
    }

    /**
     * AllUsersの強制割り当て
     * 管理者ユーザー：そのまま（デフォルトはfalse）
     * 一般ユーザー：false固定
     *
     * @param  ListBookQuery $query
     * @param  User $currentUser
     * @return string
     */
    private function resolveAllUsers(ListBookQuery $query, User $currentUser): bool
    {
        if (!$currentUser->isAdmin()) {
            return false;
        }

        return $query->allUsers;
    }
    
    /**
     * TrashTypeの強制割り当て
     * 管理者ユーザー：そのまま（デフォルトはactive）
     * 一般ユーザー：active固定
     *
     * @param  ListBookQuery $query
     * @param  User $currentUser
     * @return TrashType
     */
    private function resolveTrashType(ListBookQuery $query, User $currentUser): TrashType
    {
        if (!$currentUser->isAdmin()) {
            return TrashType::Without;
        }

        return $query->trashType;
    }
}