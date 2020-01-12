<?php


namespace App\Application\Listener;


use App\Application\Event\MessageReceived;
use App\Application\UseCase\ListProduct;
use App\Infrastructure\Helper\CommandHelper;

class ListProductListener
{
    private $listProduct;
    private $commandHelper;

    public function __construct(ListProduct $listProduct, CommandHelper $commandHelper)
    {
        $this->listProduct = $listProduct;
        $this->commandHelper = $commandHelper;
    }

    public function handle(MessageReceived $messageReceived)
    {
        $data = $this->commandHelper->validate($messageReceived, CommandHelper::LIST_PRODUCTS);

        if(! empty($data) && $this->listProductIsEmpty($data)){
            return $this->listProduct->perform();
        }

        return null;
    }

    private function listProductIsEmpty($command){
        return array_key_exists(0, $command);
    }
}
