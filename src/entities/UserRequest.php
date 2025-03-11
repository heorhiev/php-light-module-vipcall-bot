<?php

namespace light\module\vipCallBot\entities;

use light\orm\Entity;
use light\module\vipCallBot\repository\UserRequestsRepository;


class UserRequest extends Entity
{
    public $id;
    public $user_id;
    public $command;
    public $created;



    public static function fields(): array
    {
        return [
            'integer' => ['id', 'user_id'],
            'string' => ['command', 'created'],
        ];
    }


    public static function repository(): UserRequestsRepository
    {
        return new UserRequestsRepository(self::class);
    }
}