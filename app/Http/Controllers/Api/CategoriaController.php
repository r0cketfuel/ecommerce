<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categoria\StoreCategoriaRequest;
use App\Http\Requests\Categoria\UpdateCategoriaRequest;

use App\Models\Categoria;

class CategoriaController extends Controller
{
    protected $modelName;
    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function __construct()
    {
        // Nombre del modelo para las traducciones
        $this->modelName = __('models.categoria');
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function index()
    {
        return response()->json(Categoria::all(), 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function store(StoreCategoriaRequest $request, Categoria $categoria)
    {
        $categoria = Categoria::make($request->validated());
        $categoria->save();
    
        return response()->json($categoria, 201, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function show(Categoria $categoria)
    {
        return response()->json($categoria, 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        $categoria->update($request->all());
    
        return response()->json(['message' => __('messages.success.model_update', ['model' => $this->modelName])], 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return response()->json(['message' => __('messages.success.model_delete', ['model' => $this->modelName])], 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
