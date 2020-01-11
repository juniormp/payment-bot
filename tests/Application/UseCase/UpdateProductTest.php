<?php


namespace Tests\Application\UseCase;


use App\Application\UseCase\CreateProduct;
use App\Application\UseCase\UpdateProduct;
use App\Domain\Product;
use App\Infrastructure\Repository\ProductRepository;
use Exception;
use Mockery;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
    public function test_should_update_product()
    {
        $productRepository = Mockery::mock(ProductRepository::class);
        $updateProduct = new UpdateProduct($productRepository);
        $product = new Product();
        $product->name = 'Boia';

        $productRepository->shouldReceive('save')->with(
            Mockery::on(function ($arg) use ($product) {
                return $arg->name === $product->name;
            })
        )->once();

        $updateProduct->perform($product);
    }

    public function test_should_throw_exception_if_something_went_wrong()
    {
        $productRepository = Mockery::mock(ProductRepository::class);
        $updateProduct = new UpdateProduct($productRepository);
        $product = new Product();
        $product->name = 'Boia';

        $productRepository->shouldReceive('save')->andThrow(new Exception());
        $this->expectException(Exception::class);

        $updateProduct->perform($product);
    }
}
