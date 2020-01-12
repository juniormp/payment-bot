<?php


namespace App\Application\Listener;


use App\Application\Event\MessageReceived;

use App\Application\UseCase\DeleteProduct;
use App\Application\UseCase\GetProduct;
use App\Infrastructure\Service\CommandHelper;

class DeleteProductListener
{
    private $deleteProduct;
    private $commandHelper;
    private $getProduct;

    public function __construct(GetProduct $getProduct, DeleteProduct $deleteProduct, CommandHelper $commandHelper)
    {
        $this->deleteProduct = $deleteProduct;
        $this->commandHelper = $commandHelper;
        $this->getProduct = $getProduct;
    }

    public function handle(MessageReceived $messageReceived)
    {
        $data = $this->commandHelper->validate($messageReceived, CommandHelper::DELETE_PRODUCT);

        if(! empty($data) && $this->deleteProductIsEmpty($data)){
            $id = $data[1];
            $product = $this->getProduct->perform($id);
            $this->deleteProduct->perform($product);
        }
    }

    private function deleteProductIsEmpty($command){
        return array_key_exists(0, $command) && array_key_exists(1, $command);
    }
}
