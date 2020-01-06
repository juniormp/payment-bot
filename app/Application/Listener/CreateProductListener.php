<?php


namespace App\Application\Listener;


use App\Application\Event\MessageReceived;

class CreateProductListener
{
    private $messageReceived;


    public function handle(MessageReceived $messageReceived)
    {
        $this->messageReceived = $messageReceived;
    }
}
