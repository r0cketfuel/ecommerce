<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Application;

use App\Models\Administrador;
use App\Models\Usuario;
use App\Models\Articulo;
use App\Models\Factura;
use App\Models\Orden;
use App\Models\InfoComercio;
use App\Models\Visita;

class AdminController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function index()
    {
        // Usuario autenticado, redirigir a la página dashboard
        if(Auth::guard("admin")->check())
            return redirect("/admin/dashboard");

        return view("admin.index");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function login(AdminLoginRequest $request)
	{
        // Almacena usuario y contraseña despues de la validación
        $credentials = $request->getCredentials();
        
        // Verificación de credenciales
        if(!Auth::guard("admin")->validate($credentials))
            return redirect()->back()->withErrors(trans("auth.failed"));

        // Ejecuta Login y session
        Auth::guard("admin")->attempt($credentials, $request->input("check_remember"));

        // Carga los datos del usuario en sesión
        $usuario = Administrador::find(Auth::guard("admin")->id())->toArray();

        foreach($usuario as $key => $value)
            session()->put("admin.usuario.datos.$key", $value);

        return redirect()->intended("admin/dashboard");
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function dashboard()
	{
        $widgets = [
            [
                "title" => "Usuarios activos",
                "color" => "green",
                "value" => Usuario::where('estado', 1)->whereNotNull('alta')->count(),
                "link"  => ["url" => "/admin/usuarios?estado=1", "title" => "Listado"],
                "icon"  => "<i class='fa-solid fa-user-group'></i>",
                "extra" => "",
            ],
            [
                "title" => "Usuarios pendientes activación",
                "color" => "yellow",
                "value" => Usuario::whereNull("alta")->count(),
                "link"  => ["url" => "/admin/usuarios", "title" => "Listado"],
                "icon"  => "<i class='fa-solid fa-user-plus'></i>",
                "extra" => "",
            ],
            [
                "title" => "Artículos activos",
                "color" => "orange",
                "value" => Articulo::where("estado", 1)->count(),
                "link"  => ["url" => "/admin/articulos?estado=1", "title" => "Listado"],
                "icon"  => "<i class='fa-solid fa-box'></i>",
                "extra" => "",
            ],
            [
                "title" => "Artículos pausados",
                "color" => "orange",
                "value" => Articulo::where("estado", 0)->count(),
                "link"  => ["url" => "/admin/articulos?estado=0", "title" => "Listado"],
                "icon"  => "<i class='fa-solid fa-box'></i>",
                "extra" => "",
            ],
            [
                "title" => "Artículos eliminados",
                "color" => "red",
                "value" => Articulo::onlyTrashed()->count(),
                "link"  => ["url" => "/admin/articulos?eliminados=1", "title" => "Listado"],
                "icon"  => "<i class='fa-solid fa-box'></i>",
                "extra" => "",
            ],
            [
                "title" => "Ordenes pendientes",
                "color" => "blue",
                "value" => Orden::where('estado_id','1')->count(),
                "link"  => ["url" => "/admin", "title" => "Link 3"],
                "icon"  => "<i class='fa-solid fa-file-pen'></i>",
                "extra" => "",
            ],
            [
                "title" => "Ordenes en proceso",
                "color" => "green",
                "value" => Orden::where('estado_id','2')->count(),
                "link"  => ["url" => "/admin", "title" => "Link 4"],
                "icon"  => "<i class='fa-solid fa-list-check'></i>",
                "extra" => "",
            ],
            [
                "title" => "Widget 5",
                "color" => "yellow",
                "value" => rand(0,999),
                "link"  => ["url" => "/admin", "title" => "Link 5"],
                "icon"  => "<i class='fa-solid fa-paperclip'></i>",
                "extra" => "",
            ],
            [
                "title" => "Widget 6",
                "color" => "blue",
                "value" => rand(0,999),
                "link"  => ["url" => "/admin", "title" => "Link 6"],
                "icon"  => "<i class='fa-solid fa-user'></i>",
                "extra" => "",
            ],
            [
                "title" => "Widget 7",
                "color" => "green",
                "value" => rand(0,999),
                "link"  => ["url" => "/admin", "title" => "Link 7"],
                "icon"  => "<i class='fa-solid fa-truck-fast'></i>",
                "extra" => "",
            ],
            [
                "title" => "Widget 8",
                "color" => "red",
                "value" => rand(0,999),
                "link"  => ["url" => "/admin", "title" => "Link 8"],
                "icon"  => "<i class='fa-solid fa-bell'></i>",
                "extra" => "",
            ],
            [
                "title" => "Widget 9",
                "color" => "orange",
                "value" => rand(0,999),
                "link"  => ["url" => "/admin", "title" => "Link 9"],
                "icon"  => "<i class='fa-solid fa-bolt'></i>",
                "extra" => "",
            ]
        ];

        return view("admin.dashboard", compact("widgets"));
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function comercio(Request $request)
    {
        if($request->isMethod("post"))
        {
            $request->validate([

            ]);
        
            InfoComercio::updateOrCreate([], $request->all());
        
            $comercio = InfoComercio::first();
        
            session()->forget("infoComercio");

            Session::put("infoComercio", InfoComercio::first()->toArray());
        }
    
        $comercio = InfoComercio::first();

        return view("admin.comercio.index", compact("comercio"));
    }    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function facturas()
    {
        $facturas = Factura::with("tipo")->with("estado")->with("medioPago")->get();

        return view("admin.facturas.index", compact("facturas"));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function mantenimiento(Request $request)
    {
        if($request->isMethod('post'))
        {
            if($request->input('estado'))
            {
                Artisan::call('down'); 
                return response()->json(['message' => "DOWN"], 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
            }
            else
            {
                Artisan::call('up');
                return response()->json(['message' => "UP"], 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
            }
        }
    
        $status = app()->isDownForMaintenance();
    
        return view('admin.mantenimiento.index', compact('status'));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function visitas()
    {
        $visitas = Visita::all();

        return view("admin.visitas.index", compact('visitas'));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function logout(Request $request)
    {
        Auth::guard("admin")->logout();
    
        return redirect()->route('admin.login');
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
