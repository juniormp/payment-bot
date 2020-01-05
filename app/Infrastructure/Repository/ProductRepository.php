<?php


namespace App\Infrastructure\Repository;


use App\Domain\Product;

class ProductRepository extends BaseRepository
{
    protected $class = Product::class;
}
