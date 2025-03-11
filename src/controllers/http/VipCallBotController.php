<?php

namespace light\module\vipCallBot\controllers\http;

use light\module\vipCallBot\VipCallBot;
use light\http\ControllerInterface;


class VipCallBotController implements ControllerInterface
{
    public function main(): void
    {
        $bot = new VipCallBot('vipcallbot/telegram');
        $bot->run();
    }
}