<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Subcategoria\StoreSubcategoriaRequest;
use App\Http\Requests\Subcategoria\UpdateSubcategoriaRequest;

use App\Models\Subcategoria;

class SubcategoriaController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function index()
    {
        $subcategorias = Subcategoria::with("categoria")->get();

        return view("admin.subcategorias.index", compact('subcategorias'));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function create()
    {
        return view("admin.subcategorias.create");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function store(StoreSubcategoriaRequest $request)
    {
        //
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function show(Subcategoria $subcategoria)
    {
        $subcategoria = Subcategoria::find($subcategoria->id);

        return view("admin.subcategorias.show", compact('subcategoria'));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function edit(Subcategoria $subcategoria)
    {
        //
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function update(UpdateSubcategoriaRequest $request, Subcategoria $subcategoria)
    {
        //
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function destroy(Subcategoria $subcategoria)
    {
        //
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
