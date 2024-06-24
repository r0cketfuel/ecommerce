<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\Articulo\StoreArticuloRequest;
use App\Http\Requests\Articulo\UpdateArticuloRequest;

use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Talle;

class ArticuloController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function index(Request $request)
    {
        $query = Articulo::query();
    
        foreach($request->all() as $key => $value)
            if($key!="busqueda" && $key!="eliminados")
                $query->where($key, $value);
            else
                if($key=="busqueda")
                {
                    $query->where(function ($q) use ($value)
                    {
                        $q->where("codigo",         "like", "%" . $value . "%")
                        ->orWhere("nombre",         "like", "%" . $value . "%")
                        ->orWhere("descripcion",    "like", "%" . $value . "%");
                    });
                }
                else
                {
                    $query->onlyTrashed();
                }
    
        $articulos = $query
            ->with("categoria")
            ->with("subcategoria")
            ->with("rating")
            ->get();
    
        return view("admin.articulos.index", compact('articulos'));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function create()
    {
        $categorias     = Categoria::all();
        $subcategorias  = Subcategoria::all();
        $talles         = Talle::all();

        return view("admin.articulos.create", compact('categorias', 'subcategorias', 'talles'));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function store(StoreArticuloRequest $request, Articulo $articulo)
    {
        $articulo = Articulo::make($request->validated());
        $articulo->save();
    
        $articulo = Articulo::find($articulo->id);

        return view("admin.articulos.show", compact('articulo'));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function show(Articulo $articulo)
    {
        $articulo = Articulo::find($articulo->id);

        return view("admin.articulos.show", compact('articulo'));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function edit(Articulo $articulo)
    {
        $categorias     = Categoria::all();
        $subcategorias  = Subcategoria::all();
        $talles         = Talle::all();

        return view("admin.articulos.edit", compact('articulo', 'categorias', 'subcategorias', 'talles'));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function update(UpdateArticuloRequest $request, Articulo $articulo)
    {        
        $articulo->update($request->all());

        return view("admin.articulos.edit", compact('articulo', 'categorias', 'subcategorias', 'talles'))->with("success", "Artículo actualizado exitosamente");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function destroy(Articulo $articulo)
    {
        Articulo::eliminaArticulo($articulo->id);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
