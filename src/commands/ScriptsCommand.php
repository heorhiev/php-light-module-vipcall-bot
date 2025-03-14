<?php

namespace light\module\vipCallBot\commands;

use light\i18n\Loco;
use light\module\vipCallBot\traits\ContactDataTrait;
use TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;


class ScriptsCommand extends \light\tg\bot\models\Command
{
    use ContactDataTrait;


    public static function getTitle(): string
    {
        return Loco::translate('База скриптів');
    }


    public function run(): void
    {
        $user = $this->getBot()->getUser();

        switch ($this->getBot()->getIncomeMessage()->getCommand()) {
            case 'learned':
                $user->setNextCommandStep();
                break;
            case 'goodbye':
                $this->goodbye();
                return;
        }

        if (empty($user->command_step)) {
            $this->checkEducation();
            return;
        }

        if ($user->isFilledContactData() === false) {
            $this->requestAndFillContactData();
        }

        if ($user->isFilledContactData()) {
            $message = $this->getBot()
                ->getNewMessage()
                ->setMessageView('{@vipCallBotViews}/scripts/done');

            $this->getBot()->sendMessage($message);

            $message = $this->getBot()
                ->getNewMessage()
                ->setMessageView('{@vipCallBotViews}/scripts/example');

            $this->getBot()->sendMessage($message);
        }
    }


    private function checkEducation(): void
    {
        $message = $this->getBot()->getNewMessage();

        $message->setMessageText(Loco::translate('Ви вже переглянули всю інформацію і готові до роботи?'));

        $message->setKeyboardMarkup(
            new InlineKeyboardMarkup([
                [
                    ['text' => Loco::translate('Так'), 'callback_data' => '/learned'],
                    ['text' => Loco::translate('Ще ні'), 'callback_data' => '/goodbye']
                ]
            ])
        );

        $this->getBot()->sendMessage($message);
    }

    private function goodbye(): void
    {
        $message = $this->getBot()->getNewMessage();

        $message->setMessageText(Loco::translate('Це не проблема, чекаємо на Вас!'));

        $this->getBot()->sendMessage($message, false, true, true);
    }
}