<?php


namespace App\Infrastructure\Service;


use Exception;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;

class TelegramService
{
    private $botApiKey;
    private $botUserName;

    public function __construct()
    {
        $this->botApiKey = ENV('TELEGRAM_BOT_TOKEN');
        $this->botUserName = ENV('TELEGRAM_BOT_USERNAME');
    }

    public function getTelegram(): Telegram
    {
        try {
            return new Telegram($this->botApiKey, $this->botUserName);
        } catch (TelegramException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function webhook(Telegram $telegram)
    {
        try {
            $response = $telegram->handle();
        } catch (TelegramException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
