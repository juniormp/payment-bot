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

            'id' => $products[1]->id,
            'name' => $products[1]->name
       ]);
    }

    public function test_get_data_by_id_from_database()
    {
        $product = factory(Product::class)->create();
        $repository = new ProductRepository();

        $response = $repository->getById($product->id);

        $this->assertDatabaseHas('products', [
            'id' => $response->id,
            'name' => $response->name
        ]);
    }

    public function test_save_data_into_database()
    {
        $repository = new ProductRepository();
        $product = new Product();
        $product->name = 'Nike';

        $repository->save($product);

        $this->assertDatabaseHas('products', [
            'name' => $product->name
        ]);
    }

    public function test_delete_data_from_database()
    {
        $product = factory(Product::class)->create();
        $repository = new ProductRepository();

        $repository->delete($product);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
            'name' => $product->name
        ]);
    }
}
