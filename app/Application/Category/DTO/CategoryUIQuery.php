<?php

namespace App\Application\Category\DTO;

use App\Application\Category\Query\ListCategoryQuery;
use App\Application\UI\Query\UIQuery;

/**
 * DTO
 * CategoryUIQuery
 * 
 * クエリパラメータ用
 */
final class CategoryUIQuery extends UIQuery
{
    public function __construct(
        ?string $sort,
        ?string $direction,
        ?string $trashType
    ) {
        parent::__construct($sort, $direction, $trashType);
    }

    /**
     * ListCategoryQueryから生成
     *
     * @param  ListCategoryQuery $query
     * @param  bool $isAdmin
     * @return 
     */
    public static function fromQuery(ListCategoryQuery $query): self
    {
        return new self(
            $query->sort,
            $query->direction,
            $query->trashType
        );
    }

    /**
     * クエリを配列化
     *
     * @return array
     */
    public function toQueryArray(): array
    {
        return [
            'trash_type' => $this->trashType,
            'sort' => $this->sort,
            'direction' => $this->direction,
        ];
    }
}