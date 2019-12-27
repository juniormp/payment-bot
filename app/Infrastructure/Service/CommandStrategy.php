<?php


namespace App\Infrastructure\Service;


use App\Application\CreateProduct;
use App\Infrastructure\Exception\NewProductException;
use Illuminate\Support\Facades\Log;
use Longman\TelegramBot\Request;

class CommandStrategy
{
    private $commandContext;

    public function __construct(CommandContext $commandContext)
    {
        $this->commandContext = $commandContext;
    }

    public function handle(array $data)
    {
        if ($this->commandExist($data)){
            $command = explode(" ", $data['message']['text']);
            switch ($command[0]){
                case '/novoproduto':
                    try {
                        $this->createProduct($command);
                    } catch (NewProductException $e) {
                        throw new NewProductException();
                    }
                    break;
            }
        }
    }

    private function createProduct($command)
    {
        if($this->newProductIsEmpty($command)){
           $this->commandContext->setStrategy(new CreateProduct());
           $this->commandContext->perform($command);
        } else{
            throw new NewProductException();
        }
    }

    private function commandExist($data){
        $message = array_key_exists('message', $data);

        if ($message) {
            $text = array_key_exists('text', $data['message']);
        } else {
            $text = false;
        }

        return  $message && $text;
    }

    private function newProductIsEmpty($command){
        return array_key_exists(0, $command) && array_key_exists(1, $command) &&
            array_key_exists(2, $command) && array_key_exists(3, $command) &&
            array_key_exists(4, $command);
    }
}
