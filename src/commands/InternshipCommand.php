<?php

namespace light\module\vipCallBot\commands;

use light\i18n\Loco;


class InternshipCommand extends \light\tg\bot\models\Command
{
    public static function getTitle(): string
    {
        return Loco::translate('Пройти стажування');
    }


    public static function getCode(): string
    {
        return 'internship';
    }


    public function run(): void
    {
        $message = $this->getBot()->getNewMessage();

        $message->setMessageView('{@vipCallBotViews}/internship');

        $this->getBot()->sendMessage($message);
    }
}