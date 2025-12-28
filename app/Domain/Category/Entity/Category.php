<?php

namespace App\Domain\Category\Entity;

use App\Domain\Shared\ValueObject\CategoryId;
use App\Domain\Category\ValueObject\CategoryTitle;

/**
 * エンティティ
 * Category
 */
final class Category
{
    private readonly ?CategoryId $id;
    private CategoryTitle $title;

    private function __construct(
        ?CategoryId $id,
        CategoryTitle $title,
    ) {
        $this->id = $id;
        $this->title = $title;
    }
    
    /**
     * 新規作成
     * IDを持たない状態
     *
     * @return self
     */
    public static function create(
        CategoryTitle $title
    ): self {
        return new self(null, $title);
    }
    
    /**
     * 再構築
     * IDを持っている状態
     *
     * @return self
     */
    public static function reconstruct(
        CategoryId $id,
        CategoryTitle $title,
    ): self {
        return new self($id, $title);
    }
    
    /**
     * タイトル変更
     *
     * @param CategoryTitle $title
     * @return void
     */
    public function changeTitle(CategoryTitle $title): void
    {
        if ($this->title->equals($title)) return;

        $this->title = $title;
    }
        
    /** Getter */
    public function id(): ?CategoryId {return $this->id;}
    public function title(): CategoryTitle {return $this->title;}
}