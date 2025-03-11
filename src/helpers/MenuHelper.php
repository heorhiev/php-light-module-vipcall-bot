<?php

namespace light\module\vipCallBot\helpers;

use light\tg\bot\config\MenuDto;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;
use light\i18n\Loco;


class MenuHelper
{
    /**
     * @param MenuDto[] $menu
     */
    public static function getDefaultMenuKeyboard(int $userId, array $menu): ReplyKeyboardMarkup
    {
        $buttons = [];

        foreach ($menu as $item) {
            $buttons[] = ['text' => Loco::translate($item->label)];
        }

        $buttons = array_chunk($buttons, 2);

        return new ReplyKeyboardMarkup($buttons, false, true, true);
    }


    public static function getCancelMenuKeyboard(): ReplyKeyboardMarkup
    {
        $buttons[] = ['text' => Loco::translate('Cancel')];
        return new ReplyKeyboardMarkup([$buttons], true, true, true);
    }
}