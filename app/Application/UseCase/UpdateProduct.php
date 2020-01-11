<?php


namespace App\Application\UseCase;


use App\Domain\Product;
use App\Infrastructure\Repository\ProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateProduct
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function perform(Product $product)
    {
        try{
            DB::beginTransaction();

            $this->productRepository->save($product);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            throw new Exception($exception->getMessage());
        }
    }
}
