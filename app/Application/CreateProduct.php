<?php


namespace App\Application;


use Longman\TelegramBot\Request;

class CreateProduct
{
    private $telegramRequest;

    public function __construct(Request $telegramRequest)
    {
        $this->telegramRequest = $telegramRequest;
    }

    public function perform()
    {
        $this->telegramRequest::sendMessage([
            'chat_id' => '462914579',
            'text' => 'Qual o nome do seu produto?'
        ]);
    }
}
