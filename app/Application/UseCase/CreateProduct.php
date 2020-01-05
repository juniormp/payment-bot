<?php


namespace App\Application\UseCase;


use App\Domain\Product;
use App\Infrastructure\Repository\ProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateProduct
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function perform(array $attributes)
    {
        try{
            DB::beginTransaction();

            $product = new Product($attributes);
            $this->productRepository->save($product);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }
}
