<?php

namespace light\module\vipCallBot\repository;

use light\orm\repository\Repository;


class ReviewsRepository extends Repository
{
    public static function tableName(): string
    {
        return 'review';
    }
}