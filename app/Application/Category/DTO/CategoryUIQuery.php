<?php

namespace App\Application\Category\DTO;

use App\Application\Category\Query\ListCategoryQuery;
use App\Application\Shared\Enum\SortDirection;
use App\Application\Shared\Enum\TrashType;
use App\Application\UI\Query\UIQuery;

/**
 * DTO
 * CategoryUIQuery
 * 
 * クエリパラメータ用
 */
final class CategoryUIQuery extends UIQuery
{
    private const SORT_DEFAULT = 'created_at';
    private const DIRECTION_DEFAULT = SortDirection::Desc;
    private const TRASH_TYPE_DEFAULT = TrashType::Without;

    public function __construct(
        ?string $sort,
        ?SortDirection $direction,
        TrashType $trashType
    ) {
        parent::__construct(
            $sort ?? self::SORT_DEFAULT,
            $direction ?? self::DIRECTION_DEFAULT,
            $trashType
        );
    }

    /**
     * ListCategoryQueryから生成
     *
     * @param  ListCategoryQuery $query
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
            'trash_type' => $this->trashType?->value ?? self::TRASH_TYPE_DEFAULT->value,
            'sort' => $this->sort,
            'direction' => $this->direction->value,
        ];
    }
}