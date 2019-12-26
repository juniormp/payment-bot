<?php


namespace App\Infrastructure\Service;


use App\Application\CreateProduct;
use Illuminate\Support\Facades\Log;

class CommandStrategy
{
    private $commandContext;

    public function __construct(CommandContext $commandContext)
    {
        $this->commandContext = $commandContext;
    }

    public function handle(array $data){

        $exist = array_key_exists('text', $data['message']);

        if($exist){
            $data1 = $data['message']['text'];
            $data2 = explode(" ", $data1);



            switch ($data2[0]){
                case '/novoproduto':
                    $this->commandContext->setStrategy(new CreateProduct($data));
                    $this->commandContext->perform();
                    break;
                case '/floo':

                    break;
            }
        } else {

        }
    }
}
