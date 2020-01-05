<?php


namespace App\Providers;


use Carbon\Laravel\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'namespace App\Infrastructure\Repository\ProductRepository'
        );

        $this->app->bind(
            'namespace App\Infrastructure\Repository\ProductRepository'
        );
    }
}
