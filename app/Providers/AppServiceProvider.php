<?php

namespace App\Providers;

use App\Repositories\Contracts\ImageRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Repositories\ImageRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ProductRepositoryContract::class => ProductRepository::class,
        ImageRepositoryContract::class => ImageRepository::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
