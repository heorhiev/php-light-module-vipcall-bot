<?php

namespace light\module\vipCallBot\repository;

use light\orm\repository\Repository;


class UsersRepository extends Repository
{
    public static function tableName(): string
    {
        return 'user';
    }
}