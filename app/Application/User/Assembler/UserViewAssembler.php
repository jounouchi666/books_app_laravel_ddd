<?php

namespace App\Application\User\Assembler;

use App\Application\User\DTO\UserView;
use App\Domain\User\Entity\User;
use App\Infrastructure\Persistence\Eloquent\DTO\UserRecord;

/**
 * UserViewAssembler
 * 
 * UserViewを生成する
 */
final class UserViewAssembler
{
    public function __construct() {}
    /**
     * UserRecordからUserViewを生成する
     *
     * @param  UserRecord $record
     * @param  User $currentUser
     * @return UserView
     */
    public function fromRecord(UserRecord $record): UserView
    {
        return new UserView(
            $record->id,
            $record->name,
        );
    }

    /**
     * UserRecordの配列からUserViewの配列を生成する
     *
     * @param  UserRecord[] $records
     * @param  User $user
     * @return UserView[]
     */
    public function buildViewsFromRecords(array $records): array {
        return array_map(function($record) {
            return $this->fromRecord(
                $record,
            );
        }, $records);
    }
}