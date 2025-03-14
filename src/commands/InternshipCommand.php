<?php

namespace light\module\vipCallBot\commands;

use light\i18n\Loco;
use light\module\vipCallBot\traits\StepCommandTrait;


class InternshipCommand extends \light\tg\bot\models\Command
{
    use StepCommandTrait;


    public static function getTitle(): string
    {
        return Loco::translate('Пройти стажування');
    }


    public static function getCode(): string
    {
        return 'internship';
    }
}