<?php

namespace light\module\vipCallBot\entities;

use light\orm\Entity;
use light\orm\repository\Repository;
use light\module\vipCallBot\repository\UsersRepository;


class User extends Entity
{
    public $id;
    public $command;
    public $command_data;
    public $command_step;
    public $status;
    public $created_at;


    public static function fields(): array
    {
        return [
            'integer' => ['id', 'command_step', 'status'],
            'string' => ['command', 'command_data', 'created_at'],
        ];
    }


    public static function repository(): Repository
    {
        return new UsersRepository(self::class);
    }


    public function setCommand($command, string $data = ''): bool
    {
        $this->command = $command;
        $this->command_data = $data;
        $this->command_step = 0;

        return (bool) self::repository()->update(
            ['command' => $command, 'command_data' => $data, 'command_step' => 0],
            ['id' => $this->id]
        );
    }


    public function setNextCommandStep(): bool
    {
        $this->command_step++;

        return (bool) self::repository()->update(
            ['command_step' => $this->command_step],
            ['id' => $this->id]
        );
    }
}