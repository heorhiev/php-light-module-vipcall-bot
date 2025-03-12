<?php

namespace light\module\vipCallBot;

use light\tg\bot\Bot;
use light\module\vipCallBot\entities\User;
use light\module\vipCallBot\commands\{AboutCommand,
    ContactsCommand,
    CooperationCommand,
    InternshipCommand,
    ScriptsCommand,
    SocialCommand,
    StartCommand};


class VipCallBot extends Bot
{
    private static $_commands = [
        'start' => StartCommand::class,
        AboutCommand::class,
        InternshipCommand::class,
        ScriptsCommand::class,
        CooperationCommand::class,
        SocialCommand::class,
        ContactsCommand::class,
    ];

    private $_user;


    public static function getCommands(): array
    {
        return self::$_commands;
    }


    public function getStoredCommand(): ?string
    {
        return $this->getUser()?->command;
    }


    public function storeCommand($command, string $data = ''): bool
    {
        return (bool) $this->getUser()->setCommand($command, $data);
    }


    public function getUser(): ?\light\orm\Entity
    {
        if (empty($this->_user)) {
            $this->_user = User::repository()->findById($this->getUserId())->asEntityOne();
        }

        return $this->_user;
    }
}