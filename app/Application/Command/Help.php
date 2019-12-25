<?php


namespace App\Application;

use Longman\TelegramBot\Request;

class Help
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function perform()
    {
        $message = "Olá, eu posso te ajudar em suas vendas e fidelizar clientes. " .
            "Se você é novo por aqui [leia nosso manual](http://www.google.com/)." .
            "\nSempre que precisar de ajuda digite o comando /ajuda" .
            "\n\nComo eu posso te ajudar hoje?".
            "\n\n/configurarpagamento configurar método de pagamento.".
            "\n/criarproduto criar um produto.".
            "\n/venderproduto vender um produto".
            "\n/contato entre em contato";

        $this->request::sendMessage([
            'chat_id' => '462914579',
            'parse_mode' => 'markdown',
            'text' => $message
        ]);
    }
}
