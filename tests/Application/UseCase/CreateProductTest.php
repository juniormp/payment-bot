<?php


namespace Tests\Application\UseCase;


use App\Application\UseCase\CreateProduct;
use App\Domain\Product;
use App\Infrastructure\Repository\ProductRepository;
use Exception;
use Mockery;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    public function test_should_create_new_product()
    {
        $productRepository = Mockery::mock(ProductRepository::class);
        $createProduct = new CreateProduct($productRepository);
        $attributes = ['name' => 'nike'];
        $product = $this->createMock(Product::class);
        $this->app->bind(Product::class, function () use ($product) {
            return $product;
        });

        $productRepository->shouldReceive('save')->with(
            Mockery::on(function ($arg) use ($attributes) {
                return $arg['name'] === $attributes['name'];
            })
        )->once();

        $createProduct->perform($attributes);
    }

    public function test_should_throw_exception_if_something_went_wrong()
    {
        $productRepository = Mockery::mock(ProductRepository::class);
        $createProduct = new CreateProduct($productRepository);
        $attributes = ['name' => 'nike'];
        $product = $this->createMock(Product::class);
        $this->app->bind(Product::class, function () use ($product) {
            return $product;
        });
        $productRepository->shouldReceive('save')
        ->andThrow(new Exception());

        $createProduct->perform($attributes);

        $this->expectException(Exception::class);
    }
}
