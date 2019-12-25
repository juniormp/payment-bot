<?php


namespace App\Application;


use App\Infrastructure\Service\TelegramService;

class HandleRequest
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
