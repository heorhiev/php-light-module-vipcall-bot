<?php

namespace light\module\vipCallBot\commands;

use light\i18n\Loco;

class AboutCommand extends \light\tg\bot\models\Command
{
    public static function getTitle(): string
    {
        return Loco::translate('Про компанію');
    }


    public function run(): void
    {
        $message = $this->getBot()->getNewMessage();

        $message->setMessageView('{@vipCallBotViews}/about');

        $this->getBot()->sendMessage($message);
    }
}