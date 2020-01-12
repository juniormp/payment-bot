<?php


namespace Tests\Application\Listener;


use App\Application\Event\MessageReceived;
use App\Application\Listener\ListProductListener;
use App\Application\UseCase\ListProduct;
use App\Domain\Product;
use App\Infrastructure\Helper\CommandHelper;
use Illuminate\Support\Collection;
use Mockery;
use Tests\TestCase;

class ListProductListenerTest extends TestCase
{
    public function test_should_handle_message_received_event_to_list_all_products()
    {
        $listProduct = Mockery::mock(ListProduct::class);
        $products = new Collection(Product::class);
        $commandHelper = Mockery::mock(CommandHelper::class);
        $listProductListener = new ListProductListener($listProduct, $commandHelper);
        $messageReceived = new MessageReceived($this->messageReceived());
        $attributes = $this->data();
        $commandHelper->shouldReceive('validate')
            ->with($messageReceived, CommandHelper::LIST_PRODUCTS)
            ->andReturn($attributes);

        $listProduct->shouldReceive('perform')->andReturn($products);

        $response = $listProductListener->handle($messageReceived);

        $this->assertEquals($products, $response);
    }

    public function test_should_not_handle_message_received_event_when_is_not_list_all_product_command()
    {
        $listProduct = Mockery::mock(ListProduct::class);
        $commandHelper = Mockery::mock(CommandHelper::class);
        $listProductListener = new ListProductListener($listProduct, $commandHelper);
        $messageReceived = new MessageReceived($this->messageReceived());
        $commandHelper->shouldReceive('validate')
            ->with($messageReceived, CommandHelper::LIST_PRODUCTS)
            ->andReturn([]);

        $listProduct->shouldNotReceive('perform');

        $listProductListener->handle($messageReceived);
    }

    public function data(){
        return array(
            0 => "/listarprodutos"
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
                    'text' => '/listarprodutos',
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
