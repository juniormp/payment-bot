<?php


namespace Tests\Infrastucture\Service;


use App\Application\CreateProduct;
use App\Infrastructure\Service\Command;
use App\Infrastructure\Service\CommandContext;
use Mockery;
use Tests\TestCase;

class CommandStrategyTest extends TestCase
{
    public function test_should_redirect_to_create_product()
    {
        $data = $this->response();
        $commandContext = Mockery::spy(CommandContext::class);
        $command = new Command($commandContext);
        $createProduct = $this->createMock(CreateProduct::class);
        app()->bind(CreateProduct::class, function() use($createProduct){
            return $createProduct;
        });


        $commandContext->shouldReceive('setStrategy')->with($createProduct)->once();

        $commandContext->shouldReceive('perform')->with($data)->once();

        $command->handle($data);
    }


    public function response(){
        return array (
            'update_id' => 919483646,
            'message' =>
                array (
                    'message_id' => 839,
                    'from' =>
                        array (
                            'id' => 462914579,
                            'is_bot' => false,
                            'first_name' => 'Maurício',
                            'last_name' => 'Junior',
                            'username' => 'juniormp',
                            'language_code' => 'en',
                        ),
                    'chat' =>
                        array (
                            'id' => 462914579,
                            'first_name' => 'Maurício',
                            'last_name' => 'Junior',
                            'username' => 'juniormp',
                            'type' => 'private',
                        ),
                    'date' => 1577286228,
                    'text' => '/novoproduto Boia 399.99 5 https://i.ibb.co/gvBWCz7/rosa-flamingo.jpg',
                    'entities' =>
                        array (
                            0 =>
                                array (
                                    'offset' => 0,
                                    'length' => 12,
                                    'type' => 'bot_command',
                                ),
                            1 =>
                                array (
                                    'offset' => 14,
                                    'length' => 1,
                                    'type' => 'code',
                                ),
                            2 =>
                                array (
                                    'offset' => 53,
                                    'length' => 42,
                                    'type' => 'url',
                                ),
                            3 =>
                                array (
                                    'offset' => 96,
                                    'length' => 1,
                                    'type' => 'code',
                                ),
                        ),
                ),
        );
    }
}
