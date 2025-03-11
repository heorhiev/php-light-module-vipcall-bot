<?php

namespace light\module\vipCallBot;

use light\tg\bot\Bot;
use light\module\vipCallBot\entities\User;
use light\module\vipCallBot\commands\{
    ContactsCommand,
    CooperationCommand,
    InternshipCommand,
    ScriptsCommand,
    SocialCommand,
    StartCommand};


class VipCallBot extends Bot
{
    private static $_commands = [
        StartCommand::class,
        InternshipCommand::class,
        ScriptsCommand::class,
        CooperationCommand::class,
        SocialCommand::class,
        ContactsCommand::class,
    ];


    public static function getCommands(): array
    {
        return self::$_commands;
    }


    public function getStoredCommand(): ?string
    {
        $user = User::repository()->findById($this->getUserId())->asEntityOne();
        return $user?->command;
    }


    public function storeCommand($command, string $data = ''): bool
    {
        return (bool) User::repository()->update(
            ['command' => $command, 'command_data' => $data],
            ['id' => $this->getUserId()]
        );
    }


    public function getDefaultHandler(): ?string
    {
        return null;
    }
}