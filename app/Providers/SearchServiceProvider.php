<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Subcategoria;

class SearchServiceProvider extends ServiceProvider
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
    public function boot(Request $request): void
    {
        view()->composer('shop.index', function($view) use ($request)
        {
            $busqueda = [
                "titulo"    => "Todos los artículos",
                "searchbar" => "",
                "params"    => []
            ];

            if($request->filled("busqueda") && $request->input("busqueda") != "")
            {
                $busqueda["titulo"]     = "Resultados de la búsqueda: '" . $request->input("busqueda") . "'";
                $busqueda["searchbar"]  = $request->input("busqueda");
                $busqueda["params"]     = ["query" => $request->input("busqueda")];
            }
            else
            {
                if($request->filled("categoria"))
                {
                    $busqueda["titulo"] = Categoria::find($request->input("categoria"))["nombre"];
                    $busqueda["params"] = ["categoria" => $request->input("categoria")];
                }
                else
                {
                    if($request->filled("subcategoria"))
                    {
                        $subcategoria   = Subcategoria::find($request->input("subcategoria"));
                        $categoria      = Categoria::find($subcategoria["categoria_id"]);

                        $busqueda["titulo"] = $categoria["nombre"] . " > " . $subcategoria["nombre"];
                        $busqueda["params"] = ["subcategoria" => $request->input("subcategoria")];
                    }
                }
            }
            
            if($request->filled("sort") && $request->filled("order"))
            {
                $busqueda["params"]["sort"]     = $request->input("sort");
                $busqueda["params"]["order"]    = $request->input("order");
            }

            // Listado de artículos
            $items = Articulo::search($busqueda["params"])->appends(request()->query());

            $view->with(compact("items", "busqueda"));
        });
    }
}
