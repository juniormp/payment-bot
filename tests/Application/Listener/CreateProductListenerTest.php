<?php


namespace Tests\Application\Listener;


use App\Application\Event\MessageReceived;
use App\Application\Listener\CreateProductListener;
use App\Application\UseCase\CreateProduct;
use App\Infrastructure\Service\CommandHelper;
use Mockery;
use Tests\TestCase;

class CreateProductListenerTest extends TestCase
{
    public function test_should_handle_message_received_event()
    {
        $createProduct = Mockery::mock(CreateProduct::class);
        $commandHelper = Mockery::mock(CommandHelper::class);
        $createProductListener = new CreateProductListener($createProduct, $commandHelper);
        $messageReceived = new MessageReceived($this->messageReceived());
        $attributes = $this->data();
        $commandHelper->shouldReceive('validate')
            ->with($messageReceived, CommandHelper::CREATE_PRODUCT)
            ->andReturn($attributes);

        $createProduct->shouldReceive('perform')
            ->with(\Mockery::on(function($arg) use($attributes) {
                return $arg['name'] === $attributes[1];
            }))->once();

        $createProductListener->handle($messageReceived);
    }

    public function test_should_not_handle_message_received_event_when_is_not_create_product_command()
    {
        $createProduct = Mockery::mock(CreateProduct::class);
        $commandHelper = Mockery::mock(CommandHelper::class);
        $createProductListener = new CreateProductListener($createProduct, $commandHelper);
        $messageReceived = new MessageReceived($this->messageReceived());
        $attributes = $this->data();
        $commandHelper->shouldReceive('validate')
            ->with($messageReceived, CommandHelper::CREATE_PRODUCT)
            ->andReturn([]);

        $createProduct->shouldNotReceive('perform');

        $createProductListener->handle($messageReceived);
    }

    public function data(){
        return array(
            0 => "/novoproduto",
            1 => "BoiaFlamingoRosa",
            2 => "399.99",
            3 => "5",
            4 => "https://i.ibb.co/gvBWCz7/rosa-flamingo.jpg"
        );
    }

    public function messageReceived()
    {
        return array(
            'update_id' => 919483822,
            'message' =>
                array(
                    'message_id' => 1441,
                    'from' =>
                        array(
                            'id' => 462914579,
                            'is_bot' => false,
                            'first_name' => 'Maurício',
                            'last_name' => 'Junior',
                            'username' => 'juniormp',
                            'language_code' => 'en',
                        ),
                    'chat' =>
                        array(
                            'id' => 462914579,
                            'first_name' => 'Maurício',
                            'last_name' => 'Junior',
                            'username' => 'juniormp',
                            'type' => 'private',
                        ),
                    'date' => 1578275063,
                    'text' => '/novoproduto BoiaFlamingoRosa 399.99 5 https://i.ibb.co/gvBWCz7/rosa-flamingo.jpg',
                    'entities' =>
                        array(
                            0 =>
                                array(
                                    'offset' => 0,
                                    'length' => 12,
                                    'type' => 'bot_command',
                                ),
                            1 =>
                                array(
                                    'offset' => 39,
                                    'length' => 42,
                                    'type' => 'url',
                                ),
                        ),
                ),
        );
    }
}
