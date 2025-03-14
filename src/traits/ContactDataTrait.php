<?php

namespace light\module\vipCallBot\traits;

use light\i18n\Loco;
use light\module\vipCallBot\VipCallBot;


/**
 * @method VipCallBot getBot
 * @method string getCode
 */
trait ContactDataTrait
{
    private function requestAndFillContactData(): void
    {
        $contact = $this->getBot()->getDataFromRequest()?->getMessage()?->getContact();

        if (empty($contact)) {
            $this->requestContactData();
        } else {
            $this->getBot()->getUser()->setContact($contact);

            $message = $this->getBot()
                ->getNewMessage()
                ->setMessageText(Loco::translate('Контакт отримано'));

            $this->getBot()->sendMessage($message);
        }
    }


    private function requestContactData(): void
    {
        $sendPhoneButton = [
            'text' => Loco::translate('Надіслати'),
            'request_contact' => true,
        ];

        $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
            [[$sendPhoneButton]],
            true,
            true,
            true
        );

        $message = $this->getBot()->getNewMessage()
            ->setMessageText(Loco::translate('Надішліть ваш контакт за допомогою кнопки в меню, будь ласка.'))
            ->setKeyboardMarkup($keyboard);

        $this->getBot()->sendMessage($message, false, true, true);
    }
}