<?php


namespace App\Application\UseCase;


use App\Infrastructure\Service\TelegramService;

class HandleWebhook
{
    private $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    public function perform(){
        $telegram = $this->telegramService->getTelegram();
        $this->telegramService->webhook($telegram);
    }
}
