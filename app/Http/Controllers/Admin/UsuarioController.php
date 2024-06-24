<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\Usuario\StoreUsuarioRequest;
use App\Http\Requests\Usuario\UpdateUsuarioRequest;

use App\Models\Usuario;

class UsuarioController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function index(Request $request)
    {
        $query = Usuario::query();
    
        foreach($request->all() as $key => $value)
            if($key!="busqueda")
                $query->where($key, $value);
            else
            {
                $query->where(function ($q) use ($value)
                {
                    $q->where("apellidos",      "like", "%" . $value . "%")
                    ->orWhere("nombres",        "like", "%" . $value . "%")
                    ->orWhere("documento_nro",  "like", "%" . $value . "%")
                    ->orWhere("cuil",           "like", "%" . $value . "%")
                    ->orWhere("cuit",           "like", "%" . $value . "%");
                });
            }
    
        $usuarios = $query
            ->with('tipoDocumento')
            ->get();
    
        return view("admin.usuarios.index", compact('usuarios'));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function create()
    {
        //
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function store(StoreUsuarioRequest $request)
    {
        //
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function show(Usuario $usuario)
    {
        $usuario = Usuario::find($usuario->id);

        return view("admin.usuarios.show", compact('usuario'));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function edit(Usuario $usuario)
    {
        //
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function update(UpdateUsuarioRequest $request, Usuario $usuario)
    {
        $usuario->update($request->all());

        return view("admin.usuarios.edit", compact('usuario'))->with("success", "Usuario actualizado exitosamente");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function destroy(Usuario $usuario)
    {
        //
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
