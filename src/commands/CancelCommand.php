<?php

namespace light\module\vipCallBot\commands;


use light\i18n\Loco;
use light\module\vipCallBot\helpers\MenuHelper;

class CancelCommand extends \light\tg\bot\models\Command
{
    public static function getTitle(): string
    {
        return Loco::translate('Cancel');
    }


    public function run(): void
    {
        $message = $this->getBot()->getNewMessage();

        $menu = $this->getBot()->getMenu();
        if ($menu) {
            $message->setKeyboardMarkup(MenuHelper::getDefaultMenuKeyboard($this->getBot()->getUserId(), $menu));
        }

        $message->setMessageView('{@vipCallBotViews}/help');

        $this->getBot()->sendMessage($message);
    }
}