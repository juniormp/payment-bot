<?php


namespace App\Http\View;

use Longman\TelegramBot\Request;

class HelpCommand
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function perform()
    {
        $message = "Oi! eu sou o Fred o Pug, vou te ajudar a impulsionar suas vendas e fidelizar novos clientes em nossa nova aventura. " .
            "Se você é novo por aqui [leia nosso manual](http://www.google.com/)." .
            "\nSempre que precisar de ajuda digite o comando /ajuda" .
            "\n\nComo eu posso te ajudar hoje?".
            "\n\n/produto criar um produto, editar e publicar.".
            "\n/configurarpagamento configurar método de pagamento.".
            "\n/contato entre em contato";

        Request::sendSticker([
            'chat_id' => '462914579',
            'sticker' => 'CAADAgAD5AEAAsoDBgsAAV18FimxHTEWBA'
        ]);

        $this->request::sendMessage([
            'chat_id' => '462914579',
            'parse_mode' => 'markdown',
            'text' => $message
        ]);
    }
}
