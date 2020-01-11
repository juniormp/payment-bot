<?php


namespace Tests\Application\UseCase;


use App\Application\UseCase\DeleteProduct;
use App\Domain\Product;
use App\Infrastructure\Repository\ProductRepository;
use Exception;
use Mockery;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    public function test_should_delete_product()
    {
        $productRepository = Mockery::mock(ProductRepository::class);
        $deleteProduct = new DeleteProduct($productRepository);
        $product = new Product();
        $product->name = 'Boia';

        $productRepository->shouldReceive('delete')->with(
            Mockery::on(function ($arg) use ($product) {
                return $arg->name === $product->name;
            })
        )->once();

        $deleteProduct->perform($product);
    }

    public function test_should_throw_exception_if_something_went_wrong()
    {
        $productRepository = Mockery::mock(ProductRepository::class);
        $deleteProduct = new DeleteProduct($productRepository);
        $product = new Product();
        $product->name = 'Boia';

        $productRepository->shouldReceive('delete')->andThrow(new Exception());
        $this->expectException(Exception::class);

        $deleteProduct->perform($product);
    }
}
