<?php

namespace light\module\vipCallBot\traits;

use light\module\vipCallBot\dto\StepDataDto;
use light\module\vipCallBot\helpers\ButtonsHelper;
use light\module\vipCallBot\VipCallBot;


/**
 * @method VipCallBot getBot
 * @method string getCode
 */
trait StepCommandTrait
{
    public function run(): void
    {
        $sent = $this->send();

        if ($sent) {
            $this->getBot()->getUser()->setNextCommandStep();
        } else {
            $message = $this->getBot()
                ->getNewMessage()
                ->setMessageView('{@vipCallBotViews}/final');

            $this->getBot()->sendMessage($message);
        }
    }


    private function send(): ?bool
    {
        $data = $this->getStepData();

        if (empty($data)) {
            return null;
        }

        if ($data->video) {
            $this->getBot()->getBotApi()->sendVideo(
                $this->getBot()->getUserId(),
                $data->video,
                null,
                $data->title,
                null,
                ButtonsHelper::getNextButton()
            );
        }

        return true;
    }


    private function getStepData(): ?StepDataDto
    {
        $code = $this->getCode();
        $step = $this->getStep();
        $data = $this->getBot()->getOptions()->data[$code][$step] ?? null;

        if ($data) {
            $data = new StepDataDto($data);
        }

        return $data;
    }


    private function getStep(): int
    {
        return (int) $this->getBot()->getUser()->command_step;
    }
}
