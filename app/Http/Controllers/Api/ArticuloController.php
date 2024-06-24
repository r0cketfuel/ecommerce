<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Articulo\StoreArticuloRequest;
use App\Http\Requests\Articulo\UpdateArticuloRequest;

use App\Models\Articulo;

class ArticuloController extends Controller
{
    protected $modelName;
    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function __construct()
    {
        // Nombre del modelo para las traducciones
        $this->modelName = __('models.articulo');
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function index()
    {
        return response()->json(Articulo::all(), 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function store(StoreArticuloRequest $request, Articulo $articulo)
    {
        $articulo = Articulo::make($request->validated());
        $articulo->save();
    
        return response()->json($articulo, 201, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function show(Articulo $articulo)
    {
        return response()->json($articulo, 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function update(UpdateArticuloRequest $request, Articulo $articulo)
    {        
        $articulo->update($request->all());
    
        return response()->json(['message' => __('messages.success.model_update', ['model' => $this->modelName])], 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function destroy(Articulo $articulo)
    {
        $articulo->delete();

        return response()->json(['message' => __('messages.success.model_delete', ['model' => $this->modelName])], 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
