<?php


namespace Tests\Application\UseCase;


use App\Application\UseCase\ListProduct;
use App\Infrastructure\Repository\ProductRepository;
use Mockery;
use Tests\TestCase;

class ListProductTest extends TestCase
{
    public function test_should_list_all_products(){
        $productRepository = Mockery::mock(ProductRepository::class);
        $listProduct = new ListProduct($productRepository);

        $productRepository->shouldReceive('getAll')->once();

        $listProduct->perform();
    }
}
