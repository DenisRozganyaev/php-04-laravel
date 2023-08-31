<?php

namespace App\Providers;

use App\Repositories\Contracts\ImageRepositoryContract;
use App\Repositories\Contracts\OrderRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Repositories\ImageRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Services\Contracts\InvoicesServiceContract;
use App\Services\Contracts\PaypalServiceContract;
use App\Services\InvoicesService;
use App\Services\PaypalService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ProductRepositoryContract::class => ProductRepository::class,
        ImageRepositoryContract::class => ImageRepository::class,
        OrderRepositoryContract::class => OrderRepository::class,
        PaypalServiceContract::class => PaypalService::class,
        InvoicesServiceContract::class => InvoicesService::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        if(config('app.env') === 'production') {
            $this->app['request']->server->set('HTTPS', true);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//        logs()->info('LOCALE BEFORE => ' . app()->currentLocale() . ' => ' . session()->get('locale'));
        app()->setLocale(session()->get('locale') ?? 'en');
//        logs()->info('LOCALE AFTER => ' . app()->currentLocale() . ' => ' . session()->get('locale'));
    }
}
