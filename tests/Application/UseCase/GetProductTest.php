<?php


namespace Tests\Application\UseCase;


use App\Application\UseCase\GetProduct;
use App\Application\UseCase\ListProduct;
use App\Infrastructure\Repository\ProductRepository;
use Mockery;
use Tests\TestCase;


class GetProductTest extends TestCase
{
    public function test_should_list_all_products(){
        $productRepository = Mockery::mock(ProductRepository::class);
        $getProduct = new GetProduct($productRepository);
        $id = 1;

        $productRepository->shouldReceive('getById')->with($id)->once();

        $getProduct->perform($id);
    }
}
