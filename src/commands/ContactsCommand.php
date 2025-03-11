<?php

namespace light\module\vipCallBot\commands;

use light\i18n\Loco;

class ContactsCommand extends \light\tg\bot\models\Command
{
    public static function getTitle(): string
    {
        return Loco::translate('Контакти VipCall');
    }


    public function run(): void
    {
        $message = $this->getBot()->getNewMessage();

        $message->setMessageView('{@vipCallBotViews}/contacts');

        $this->getBot()->sendMessage($message);
    }
}