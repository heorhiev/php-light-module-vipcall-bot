<?php

namespace light\module\vipCallBot\commands;

use light\i18n\Loco;
use light\module\vipCallBot\entities\Review;
use light\module\vipCallBot\entities\User;


class AddReviewCommand extends \light\tg\bot\models\Command
{
    public static function getTitle(): string
    {
        return Loco::translate('Add a review');
    }


    /**
     * @throws \Exception
     */
    public function run(): void
    {
        $reviewText = $this->getBot()->getIncomeMessage()->getText();

        $id = Review::repository()->create([
            'sender_id' => $this->getUserId(),
            'recipient_id' => $this->getRecipientId(),
            'text' => $reviewText,
        ]);

        if (empty($id)) {
            throw new \Exception('Error creating review');
        }

        $message = $this->getBot()->getNewMessage();

        $message->setMessageView('{@vipCallBotViews}/review_add/thanks');

        $this->getBot()->sendMessage($message);
    }


    private function getRecipientId(): int
    {
        /** @var User $user */
        $user = User::repository()->findById($this->getUserId())->asEntityOne();
        return $user?->command_data;
    }
}