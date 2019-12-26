<?php


namespace App\Infrastructure\Service;


use App\Application\CreateProduct;

class Command
{
    private $commandContext;

    public function __construct(CommandContext $commandContext)
    {
        $this->commandContext = $commandContext;
    }

    public function handle(array $data){
        $data = $data['message']['text'];
        $data = explode(" ", $data);

        switch ($data[0]){
            case '/novoproduto':
                $this->commandContext->setStrategy(new CreateProduct());
                $this->commandContext->perform($data);
                break;
            case '/floo':

                break;
        }

    }
}
