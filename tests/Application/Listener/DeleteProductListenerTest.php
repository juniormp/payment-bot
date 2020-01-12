<?php


namespace Tests\Application\Listener;


use App\Application\Event\MessageReceived;
use App\Application\Listener\DeleteProductListener;
use App\Application\UseCase\DeleteProduct;
use App\Application\UseCase\GetProduct;
use App\Domain\Product;
use App\Infrastructure\Helper\CommandHelper;
use Mockery;
use Tests\TestCase;

class DeleteProductListenerTest extends TestCase
{
    public function test_should_handle_message_received_event_to_delete_product()
    {
        $getProduct = Mockery::mock(GetProduct::class);
        $product = new Product();
        $deleteProduct = Mockery::mock(DeleteProduct::class);
        $commandHelper = Mockery::mock(CommandHelper::class);
        $deleteProductListener = new DeleteProductListener($getProduct, $deleteProduct, $commandHelper);
        $messageReceived = new MessageReceived($this->messageReceived());
        $attributes = $this->data();
        $commandHelper->shouldReceive('validate')
            ->with($messageReceived, CommandHelper::DELETE_PRODUCT)
            ->andReturn($attributes);
        $getProduct->shouldReceive('perform')
            ->with(1)
            ->andReturn($product);

        $deleteProduct->shouldReceive('perform')
            ->with(\Mockery::on(function($arg) use($product) {
                return $arg === $product;
            }))->once();

        $deleteProductListener->handle($messageReceived);
    }

    public function test_should_not_handle_message_received_event_when_is_not_delete_product_command()
    {
        $getProduct = Mockery::mock(GetProduct::class);
        $deleteProduct = Mockery::mock(DeleteProduct::class);
        $commandHelper = Mockery::mock(CommandHelper::class);
        $deleteProductListener = new DeleteProductListener($getProduct, $deleteProduct, $commandHelper);
        $messageReceived = new MessageReceived($this->messageReceived());
        $commandHelper->shouldReceive('validate')
            ->with($messageReceived, CommandHelper::DELETE_PRODUCT)
            ->andReturn([]);

        $deleteProduct->shouldNotReceive('perform');

        $deleteProductListener->handle($messageReceived);
    }

    public function data(){
        return array(
            0 => "/excluirProduto",
            1 => 1
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
                    'text' => '/excluirProduct 1',
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
