<?php


namespace App\Providers;


use App\Infrastructure\Repository\ProductRepository;
use Carbon\Laravel\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ProductRepository::class, function () {
            return new ProductRepository();
        });
    }
}
