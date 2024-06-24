<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Favorito\StoreFavoritoRequest;
use App\Http\Requests\Favorito\UpdateFavoritoRequest;

use Illuminate\Database\QueryException;

use App\Models\Favorito;

class FavoritoController extends Controller
{
    protected $modelName;
    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function __construct()
    {
        // Nombre del modelo para las traducciones
        $this->modelName = __('models.favorito');
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function index()
    {
        return response()->json(Favorito::all(), 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function store(StoreFavoritoRequest $request, Favorito $favorito)
    {
        // Se debe obtener el usuario autenticado en lugar de esperar el id como parámetro. Dejo pendiente
        try
        {
            $favorito = Favorito::withTrashed()->where('usuario_id', $request->usuario_id)->where('articulo_id', $request->articulo_id)->first();
    
            if($favorito)
            {
                if($favorito->trashed())
                {
                    $favorito->restore();

                    $response = [
                        'success'   => true,
                        'message'   => 'El artículo ha sido agregado a favoritos'
                    ];

                    return response()->json($response, 201, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
                }
                else
                {
                    $response = [
                        'success'   => false,
                        'message'   => 'El artículo ya se encontraba en tu lista de favoritos'
                    ];

                    return response()->json($response, 201, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
                }
            }
    
            $favorito = Favorito::make($request->validated());
            $favorito->save();

            $response = [
                'success'   => true,
                'message'   => 'El artículo ha sido agregado a favoritos'
            ];

            return response()->json($response, 201, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
        
        catch(QueryException $exception)
        {
            $response = [
                'success'   => false,
                'message'   => 'Error al agregar el item a favoritos'
            ];

            return response()->json($response, 201, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function show(Favorito $favorito)
    {
        return response()->json($favorito, 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function update(UpdateFavoritoRequest $request, Favorito $favorito)
    {        
        $favorito->update($request->all());
    
        return response()->json(['message' => __('messages.success.model_update', ['model' => $this->modelName])], 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function destroy(Favorito $favorito)
    {
        $favorito->delete();

        return response()->json(['message' => __('messages.success.model_delete', ['model' => $this->modelName])], 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
