<?php

namespace App\Application\Dashboard\Repository;

use App\Application\Dashboard\DTO\DashboardDto;
use App\Application\Dashboard\DTO\DashboardSummaryDto;
use App\Application\Dashboard\DTO\TrashSummaryDto;
use App\Application\Dashboard\Query\DashboardQuery;

interface DashboardQueryServiceInterface
{
    /**
     * サマリーを取得
     *
     * @param  DashboardQuery $query
     * @return DashboardDto
     */
    public function getSummary(DashboardQuery $query): DashboardSummaryDto;

    /**
     * 削除済み件数を取得
     *
     * @return TrashSummaryDto
     */
    public function getTrashSummary(): TrashSummaryDto;
}