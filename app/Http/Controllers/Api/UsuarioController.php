<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Usuario\StoreUsuarioRequest;
use App\Http\Requests\Usuario\UpdateUsuarioRequest;

use App\Models\Usuario;

class UsuarioController extends Controller
{
    protected $modelName;
    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function __construct()
    {
        // Nombre del modelo para las traducciones
        $this->modelName = __('models.usuario');
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function index()
    {
        return response()->json(Usuario::all(), 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function store(StoreUsuarioRequest $request, Usuario $usuario)
    {
        $usuario = Usuario::make($request->validated());
        $usuario->save();
    
        return response()->json($usuario, 201, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function show(Usuario $usuario)
    {
        return response()->json($usuario, 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function update(UpdateUsuarioRequest $request, Usuario $usuario)
    {
        $usuario->update($request->all());
    
        return response()->json(['message' => __('messages.success.model_update', ['model' => $this->modelName])], 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        
        return response()->json(['message' => __('messages.success.model_delete', ['model' => $this->modelName])], 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function checkUsernameAvailability(Request $request)
    {
        $username       = $request->input('username');
        $isAvailable    = $this->isUsernameAvailable($username);

        return response()->json(['is_available' => $isAvailable]);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    protected function isUsernameAvailable($username)
    {
        $count = Usuario::where("username", $username)->count();

        return !$count;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
