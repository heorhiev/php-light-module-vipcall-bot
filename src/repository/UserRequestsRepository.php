<?php

namespace light\module\vipCallBot\repository;

use light\orm\repository\Repository;


class UserRequestsRepository extends Repository
{
    public static function tableName(): string
    {
        return 'user_request';
    }
}