<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subcategoria\StoreSubcategoriaRequest;
use App\Http\Requests\Subcategoria\UpdateSubcategoriaRequest;

use App\Models\Subcategoria;

class SubcategoriaController extends Controller
{
    protected $modelName;
    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function __construct()
    {
        // Nombre del modelo para las traducciones
        $this->modelName = __('models.subcategoria');
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function index()
    {
        return response()->json(Subcategoria::all(), 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function store(StoreSubcategoriaRequest $request, Subcategoria $subcategoria)
    {
        $subcategoria = Subcategoria::make($request->validated());
        $subcategoria->save();
    
        return response()->json($subcategoria, 201, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function show(Subcategoria $subcategoria)
    {
        return response()->json($subcategoria, 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function update(UpdateSubcategoriaRequest $request, Subcategoria $subcategoria)
    {
        $subcategoria->update($request->all());
    
        return response()->json(['message' => __('messages.success.model_update', ['model' => $this->modelName])], 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function destroy(Subcategoria $subcategoria)
    {
        $subcategoria->delete();

        return response()->json(['message' => __('messages.success.model_delete', ['model' => $this->modelName])], 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
