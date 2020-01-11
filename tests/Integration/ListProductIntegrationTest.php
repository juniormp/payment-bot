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

        $listProduct->perform();

        $this->assertCount(2, $products);
        $this->assertDatabaseHas('products',[
            'id'                => $products[0]->id,
            'name'              => $products[0]->name,
            'quantity'          => $products[0]->quantity,
            'amount'            => $products[0]->amount,
            'url'               => $products[0]->url,

            'id'                => $products[1]->id,
            'name'              => $products[1]->name,
            'quantity'          => $products[1]->quantity,
            'amount'            => $products[1]->amount,
            'url'               => $products[1]->url
        ]);
    }
}
