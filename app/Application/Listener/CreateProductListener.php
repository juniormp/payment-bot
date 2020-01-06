<?php


namespace App\Application\Listener;


use App\Application\Event\MessageReceived;
use App\Application\UseCase\CreateProduct;
use App\Infrastructure\Service\CommandHelper;

class CreateProductListener
{
    private $createProduct;
    private $commandHelper;

    public function __construct(CreateProduct $createProduct, CommandHelper $commandHelper)
    {
        $this->createProduct = $createProduct;
        $this->commandHelper = $commandHelper;
    }

    public function handle(MessageReceived $messageReceived)
    {
        $data = $this->commandHelper->validate($messageReceived, CommandHelper::CREATE_PRODUCT);

        if(! empty($data) && $this->newProductIsEmpty($data)){
            $attributes = [
                'name' => $data[1],
                'amount' => $data[2],
                'quantity' => $data[3],
                'url' => $data[4]
            ];

            $this->createProduct->perform($attributes);
        }
    }

    private function newProductIsEmpty($command){
        return array_key_exists(0, $command) && array_key_exists(1, $command) &&
            array_key_exists(2, $command) && array_key_exists(3, $command) &&
            array_key_exists(4, $command);
    }
}
