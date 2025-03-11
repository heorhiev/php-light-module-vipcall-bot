<?php

namespace light\module\vipCallBot;

use light\app\services\AliasService;
use light\module\vipCallBot\controllers\http\VipCallBotController;
use light\app\BootstrapInterface;
use light\http\Http;


class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app): void
    {
        Http::addRoute('anti-bot-handler', VipCallBotController::class);
        AliasService::setPath('{@vipCallBotViews}', __DIR__ . '/views');
    }
}
