<?php

namespace light\module\vipCallBot\commands;

use light\i18n\Loco;
use light\module\vipCallBot\traits\StepCommandTrait;


class CooperationCommand extends \light\tg\bot\models\Command
{
    use StepCommandTrait;

    public static function getTitle(): string
    {
        return Loco::translate('Умови співпраці');
    }


    public static function getCode(): string
    {
        return 'cooperation';
    }
}