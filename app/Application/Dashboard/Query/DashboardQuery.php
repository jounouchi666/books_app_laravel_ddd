<?php

namespace App\Application\Dashboard\Query;

/**
 * クエリオブジェクト
 * ダッシュボードコンテンツ用
 */
class DashboardQuery
{
    public function __construct(
        public readonly int $userId,
        public readonly ?int $showBookLimit = null
    ) {}
}