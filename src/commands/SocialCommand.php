<?php

namespace light\module\vipCallBot\commands;

use light\i18n\Loco;

class SocialCommand extends \light\tg\bot\models\Command
{
    public static function getTitle(): string
    {
        return Loco::translate('Соціальні мережі');
    }


    public function run(): void
    {
        $message = $this->getBot()->getNewMessage();

        $message->setMessageView('{@vipCallBotViews}/social');

        $this->getBot()->sendMessage($message);
    }
}