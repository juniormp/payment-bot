<?php


namespace App\Application\UseCase;


use App\Infrastructure\Repository\ProductRepository;

class ListProduct
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function perform()
    {
        return $this->productRepository->getAll();
    }
}
