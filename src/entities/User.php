<?php

namespace light\module\vipCallBot\entities;

use light\orm\Entity;
use light\orm\repository\Repository;
use light\module\vipCallBot\repository\UsersRepository;


class User extends Entity
{
    public $id;
    public $name;
    public $phone;
    public $command;
    public $command_data;
    public $command_step;
    public $status;
    public $created_at;


    public static function fields(): array
    {
        return [
            'integer' => ['id', 'command_step', 'status'],
            'string' => ['name', 'phone', 'command', 'command_data', 'created_at'],
        ];
    }


    public static function repository(): Repository
    {
        return new UsersRepository(self::class);
    }


    public function setContact(\TelegramBot\Api\Types\Contact $contact): bool
    {
        $this->phone = $contact->getPhoneNumber();
        $this->name = $contact->getFirstName();

        return $this->save();
    }


    public function setCommand($command, string $data = ''): bool
    {
        $this->command = $command;
        $this->command_data = $data;
        $this->command_step = 0;

        return $this->save();
    }


    public function setNextCommandStep(): bool
    {
        $this->command_step++;

        return $this->save();
    }


    public function isFilledContactData(): bool
    {
        return (bool) $this->phone;
    }


    public function save(): bool
    {
        return (bool) self::repository()->update(get_object_vars($this), ['id' => $this->id]);
    }
}