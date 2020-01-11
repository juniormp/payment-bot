<?php


namespace App\Application\UseCase;


use App\Infrastructure\Repository\ProductRepository;

class GetProduct
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function perform(int $id)
    {
        return $this->productRepository->getById($id);
    }
}
