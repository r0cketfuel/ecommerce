<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ShoppingCartService;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer('shop.layout.master', function ($view) {
            $cartService = app(ShoppingCartService::class);
            $totalItems = $cartService->totalItems();
            $view->with('shoppingCartItemQty', $totalItems);
        });
    }
}
