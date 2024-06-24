<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Services\ShoppingCartService;
use App\Services\Barcode128;
use App\Services\MercadoPago;
use Illuminate\Support\Facades\Hash;

use App\Models\Usuario;
use App\Models\Articulo;
use App\Models\Banner;
use App\Models\Genero;
use App\Models\Rating;
use App\Models\TipoDocumento;
use App\Services\FavoritosService;

class ShopController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
	public function index()
	{
        $banners = Banner::vigentes();

        return view("shop.index", compact("banners"));
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function item($id)
	{
        $validator = Validator::make(["id" => $id], [
            "id" => "required|numeric|min:1|exists:articulos,id",
        ]);
    
        if($validator->fails())
            return redirect("shop")->withErrors($validator->errors());

        $item = Articulo::info($id);
        
        if($item && $item->estado == 1)
        {
            // Incrementar y obtener las calificaciones del artículo
            $ratings = Rating::incrementaVisualizacion($id);

            return view("shop.item.index", compact("item", "ratings"));
        }

        return redirect("shop");
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function banners(string $link)
	{
        return view("shop.banners.$link");
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function favoritos(FavoritosService $favoritoService)
	{
        $favoritos  = $favoritoService->items();
        $items      = [];

        for($i=0;$i<count($favoritos);++$i)
            array_push($items, Articulo::info($favoritos[$i]["articulo_id"]));

        return view("shop.user.favoritos", compact("items"));
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function login()
    {
        // Usuario autenticado, redirigir a la página cuenta de usuario
        if(Auth::check())
            return redirect("shop/account");
        
        return view("shop.login");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function register()
    {
        // Usuario autenticado, redirigir a la página de inicio
        if(Auth::check())
            return redirect("shop");

        $generos            = Genero::all();
        $tiposDocumentos    = TipoDocumento::all();
    
        return view("shop.register.index", compact("generos", "tiposDocumentos"));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function recovery()
    {
        // Usuario autenticado, redirigir a la página de inicio
        if(Auth::check())
            return redirect("shop");
            
        return view("shop.recovery");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function infoPago($id)
    {
        //Pagos de pruebas: 
        //1319858771 -> Pagofácil

        $mercadoPago    = new MercadoPago(env('MERCADOPAGO_ACCESS_TOKEN'));
        $response       = $mercadoPago->infoPago($id);

        if($response["success"] == True)
        {
            $estado = $response["data"]["payment"];
            $image = NULL;
            if(isset($estado->transaction_details->barcode["content"]))
            {
                $barcode = new Barcode128;
                $barcode->setData($estado->transaction_details->barcode["content"]);
                $barcode->setDimensions(350, 50);
                $barcode->draw();
                $image = $barcode->base64();
            }
            
            return view("shop.user.infoPago", compact("estado", "image"));
        }

        return redirect("shop")->withErrors("Pago no encontrado");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function account(Request $request)
    {
        if($request->isMethod("post"))
        {
            $user = Usuario::find(Auth::id());

            if($request->has("form1"))
            {
                $user->fill($request->except(['apellidos', 'nombres', 'tipo_documento_id', 'documento_nro', 'email']));
                $user->save();
    
                // Carga los datos del usuario en sesión
                $usuario = Usuario::find(Auth::id())->toArray();
        
                foreach($usuario as $key => $value)
                    session()->put("shop.usuario.datos.$key", $value);
    
                return redirect()->route('user.account')->with('success', trans('messages.profileUpdateSuccess'));
            }

            if($request->has("form2"))
            {
                
            }

            if($request->has("form3"))
            {
                $request->validate([
                    'password_old'     => 'required',
                    'password_new'     => 'required|min:8',
                    'password_repeat'  => 'required|same:password_new',
                ]);

                // Verificar que la contraseña anterior sea válida
                if(!Hash::check($request->input('password_old'), $user->password))
                    return redirect()->back()->with('error', trans('auth.password_old'));
    
                // Actualizar la contraseña del usuario en la base de datos
                $user->password = $request->input('password_new');
                $user->save();
    
                return redirect()->route('user.account')->with('success', trans('messages.passwordChangeSuccess'));
            }
        }

        $generos            = Genero::all();
        $tiposDocumentos    = TipoDocumento::all();

        return view("shop.user.account", compact("generos", "tiposDocumentos"));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function success(ShoppingCartService $shoppingCart, $order = null)
    {
        $shoppingCart->init();

        return view("shop.checkout.success", compact("order"));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function logout(UsuarioController $user, FavoritosService $favoritosService, ShoppingCartService $shoppingCartService)
    {
        $user->logout();
    
        session()->put("shop.usuario",      []);
        session()->put("shop.newsletter",   []);

        session()->forget("shop.checkout");

        $favoritosService->init();
        $shoppingCartService->init();

        return redirect("shop");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function changeLocale(Request $request)
    {
        /* https://glutendesign.com/posts/detect-and-change-language-on-the-fly-with-laravel */

        $this->validate($request, ['locale' => 'required|in:es,en']);

        Session()->put('locale', $request->locale);

        return redirect()->back();
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function compras()
    {
        $usuario = Usuario::find(Auth::id());

        $articulos = [
            [
                "id"    => 1,
            ],
            [
                "id"    => 2,
            ],
            [
                "id"    => 3,
            ],
        ];

        foreach($articulos as $articulo) {
            $items[] = Articulo::info($articulo['id']);
        }

        return view("shop.user.compras", compact("usuario", "items"));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function estadocompras()
    {
        return view("shop.user.order-status");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
