<?php


namespace App\Application\Listener;


use App\Application\Event\MessageReceived;

class CreateProductListener
{
    private $messageReceived;


    public function handle(MessageReceived $messageReceived)
    {
        //criar validaçao para saber se é  comando certo que vai cair aqui
        $this->messageReceived = $messageReceived;
    }
}
