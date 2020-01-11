<?php


namespace App\Http\View;

use Longman\TelegramBot\Request;

class ListProductCommand
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function perform()
    {
        $this->request::sendMessage([
            'chat_id' => '462914579',
            'parse_mode' => 'markdown',
            'disable_web_page_preview' => true,
            'text' => "Seus Produtos: "
        ]);
    }
}
