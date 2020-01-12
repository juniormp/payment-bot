<?php


namespace Tests\Integration;


use App\Application\UseCase\ListProduct;
use App\Domain\Product;
use App\Infrastructure\Repository\ProductRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListProductIntegrationTest  extends  TestCase
{
    use RefreshDatabase;

    public function test_should_list_all_products()
    {
        $products = factory(Product::class, 2)->create();
        $productRepository = new ProductRepository();
        $listProduct = new ListProduct($productRepository);

        $response = $listProduct->perform();

        $this->assertCount(2, $response);
        $this->assertEquals($products[0]->id, $response[0]->id);
        $this->assertEquals($products[1]->id, $response[1]->id);
    }

    public function response()
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
