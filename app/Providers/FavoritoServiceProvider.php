<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FavoritosService;

class FavoritoServiceProvider extends ServiceProvider
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
            $favoritoService = app(FavoritosService::class);
            $totalItems = $favoritoService->totalItems();
            $view->with('favoritosItemQty', $totalItems);
        });
    }
}
