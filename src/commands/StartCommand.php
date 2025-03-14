<?php

namespace light\module\vipCallBot\commands;

use light\i18n\Loco;
use light\module\vipCallBot\constants\BotConst;
use light\module\vipCallBot\entities\User;
use light\module\vipCallBot\helpers\ButtonsHelper;


class StartCommand extends \light\tg\bot\models\Command
{
    public static function getTitle(): string
    {
        return Loco::translate('start');
    }


    public function run(): void
    {
        self::createUser($this->getBot()->getUserId());

        $message = $this->getBot()->getNewMessage();

        $message->setMessageView('{@vipCallBotViews}/start');

        $this->getBot()->sendMessage($message);
    }


    private static function createUser($userId): void
    {
        User::repository()->getIdOrCreate([
            'id' => $userId,
            'status' => BotConst::USER_STATUS_ACTIVE,
        ]);
    }
}