<?php


namespace App\Http\Controllers;

use App\Application\UseCase\CreateProduct;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    private $createProduct;

    public function __construct(CreateProduct $createProduct)
    {
        $this->createProduct = $createProduct;
    }

    public function create(array $attributes){

        // colocar o validator

        $this->createProduct->perform($attributes);
    }
}
