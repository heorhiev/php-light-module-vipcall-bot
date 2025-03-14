<?php

namespace light\module\vipCallBot\commands;

use light\i18n\Loco;


class CooperationCommand extends \light\tg\bot\models\Command
{
    public static function getTitle(): string
    {
        return Loco::translate('Умови співпраці');
    }


    public static function getCode(): string
    {
        return 'cooperation';
    }


    public function run(): void
    {
        $message = $this->getBot()->getNewMessage();

        $message->setMessageView('{@vipCallBotViews}/cooperation');

        $this->getBot()->sendMessage($message);
    }
}