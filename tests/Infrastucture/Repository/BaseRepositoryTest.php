<?php


namespace Tests\Infrastucture\Repository;


use App\Domain\Product;
use App\Infrastructure\Repository\ProductRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BaseRepositoryTest extends TestCase
{
   use RefreshDatabase;

    public function test_get_all_data_from_database()
    {
        factory(Product::class, 2)->create();
        $repository = new ProductRepository();

        $products = $repository->getAll();

        $this->assertCount(2, $products);
        $this->assertDatabaseHas('products', [
            'id' => $products[0]->id,
            'name' => $products[0]->name,
            'amount' => $products[0]->amount,
            'quantity' => $products[0]->quantity,
            'url' => $products[0]->url,

            'id' => $products[1]->id,
            'name' => $products[1]->name,
            'amount' => $products[1]->amount,
            'quantity' => $products[1]->quantity,
            'url' => $products[1]->url,
       ]);
    }

    public function test_get_data_by_id_from_database()
    {
        $product = factory(Product::class)->create();
        $repository = new ProductRepository();

        $response = $repository->getById($product->id);

        $this->assertDatabaseHas('products', [
            'id' => $response->id,
            'name' => $response->name,
            'amount' => $response->amount,
            'quantity' => $response->quantity,
            'url' => $response->url,
        ]);
    }

    public function test_save_data_into_database()
    {
        $repository = new ProductRepository();
        $product = new Product();
        $product->name = 'Nike';
        $product->amount = 100.00;
        $product->quantity = 5;
        $product->url = 'https://lorempixel.com/250/250/cats/?99342';

        $repository->save($product);

        $this->assertDatabaseHas('products', [
            'name' => $product->name,
            'amount' => $product->amount,
            'quantity' => $product->quantity,
            'url' => $product->url
        ]);
    }

    public function test_delete_data_from_database()
    {
        $product = factory(Product::class)->create();
        $repository = new ProductRepository();

        $repository->delete($product);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
            'name' => $product->name,
            'amount' => $product->amount,
            'quantity' => $product->quantity,
            'url' => $product->url
        ]);
    }
}
