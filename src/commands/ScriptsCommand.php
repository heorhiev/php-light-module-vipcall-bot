<?php

namespace light\module\vipCallBot\commands;

use light\i18n\Loco;

class ScriptsCommand extends \light\tg\bot\models\Command
{
    public static function getTitle(): string
    {
        return Loco::translate('База скриптів');
    }


    public function run(): void
    {
        $message = $this->getBot()->getNewMessage();

        $message->setMessageView('{@vipCallBotViews}/scripts');

        $this->getBot()->sendMessage($message);
    }
}