<?php

namespace App\Application\Dashboard\UseCase;

use App\Application\Auth\CurrentUserProvider;
use App\Application\Dashboard\DTO\DashboardDto;
use App\Application\Dashboard\DTO\TrashSummaryDto;
use App\Application\Dashboard\Query\DashboardQuery;
use App\Application\Dashboard\Repository\DashboardQueryServiceInterface;

/**
 * ユースケース
 * Dashboard詳細表示
 */
class ShowDashboardUseCase
{
    public function __construct(
        private DashboardQueryServiceInterface $dashboardRepository,
        private CurrentUserProvider $currentUserProvider
    ) {}

    public function execute(): DashboardDto
    {
        $currentUser = $this->currentUserProvider->currentUser();
        $isAdmin = $currentUser->isAdmin();

        $dashboarcSummary = $this->dashboardRepository->getSummary(
            new DashboardQuery(
                $currentUser->id()->value(),
                null
            )
        );

        $trashSummary = $isAdmin
            ? $this->dashboardRepository->getTrashSummary()
            : TrashSummaryDto::blank();

        return new DashboardDto(
            $dashboarcSummary->readingSummary,
            $dashboarcSummary->readingBooks,
            $dashboarcSummary->byCategoryBooks,
            $trashSummary
        );
    }
}