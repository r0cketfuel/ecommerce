<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Categoria;

class CategoriaServiceProvider extends ServiceProvider
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
        view()->composer('shop.layout.master', function($view)
        {
            // Obtener las categorías con subcategorías cargadas ansiosamente
            $categorias = Categoria::with('subcategoria')->get();

            $view->with(compact("categorias"));
        });
    }
}
