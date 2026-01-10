<?php

namespace App\Application\Category\Assembler;

use App\Application\Category\DTO\CategorySelectView;
use App\Domain\User\Entity\User;
use App\Infrastructure\Persistence\Eloquent\DTO\CategoryRecord;

/**
 * CategorySelectAssembler
 * 
 * CategorySelectViewを生成する
 */
final class CategorySelectAssembler
{
    /**
     * fromRecordからCategorySelectViewを生成する
     *
     * @param  CategoryRecord $record
     * @param  User $currentUser
     * @return CategorySelectView
     */
    public function fromRecord(CategoryRecord $record): CategorySelectView
    {
        return new CategorySelectView(
            $record->id,
            $record->title,
        );
    }

    /**
     * fromRecordの配列からCategorySelectViewの配列を生成する
     *
     * @param  CategoryRecord[] $records
     * @param  User $currentUser
     * @return CategorySelectView[]
     */
    public function buildViewsFromRecords(array $records): array {
        return array_map(function($categoryRecord) {
            return $this->fromRecord($categoryRecord);
        }, $records);
    }
}