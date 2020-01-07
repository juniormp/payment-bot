<?php


namespace App\Http\View;

use Longman\TelegramBot\Request;

class CreateProductCommand
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function perform()
    {
        $message = "Para criar um produto digite /novoproduto " .
            "NomeDoProduto ValorDoProduto Quantidade UrlDaImagemDoProduto" .
            "\n\nExemplo:" .
            "\n\n /novoproduto BoiaFlamingoRosa 399.99 5 https://i.ibb.co/gvBWCz7/rosa-flamingo.jpg";

        $this->request::sendMessage([
            'chat_id' => '462914579',
            'parse_mode' => 'markdown',
            'disable_web_page_preview' => true,
            'text' => $message
        ]);
    }
}
