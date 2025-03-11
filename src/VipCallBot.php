<?php

namespace light\module\vipCallBot;

use light\tg\bot\Bot;
use light\module\vipCallBot\entities\User;
use light\module\vipCallBot\commands\{CancelCommand, ShareUserCommand, GetReviewCommand, StartCommand, HelpCommand};


class VipCallBot extends Bot
{
    private static $_commands = [
        'start' => StartCommand::class,
        'add_review' => ShareUserCommand::class,
        'get_review' => GetReviewCommand::class,
        'help' => HelpCommand::class,
        'cancel' => CancelCommand::class,
    ];


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

    public static function getCommands(): array
    {
        return self::$_commands;
    }


    public function getDefaultHandler(): ?string
    {
        if ($this->getIncomeMessage()->getUserShared()) {
            return ShareUserCommand::class;
        }

        return null;
    }
}