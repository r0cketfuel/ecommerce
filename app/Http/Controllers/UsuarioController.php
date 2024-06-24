<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Usuario\UserLoginRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Mail;
use App\Mail\SignUp;
use App\Mail\Recovery;
use App\Models\Usuario;
use App\Models\Newsletter;
use App\Services\FavoritosService;

class UsuarioController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function register(Request $request)
	{
        // Validación del campo indicador del paso
        $rules = ['currentStep' => ['required', Rule::in(['1','2'])]];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);

        // El paso actual es válido, se procede a verificar las reglas de cada paso
        switch($request->input("currentStep"))
        {
            case('1'):
            {
                $rules = [
                    "apellidos"         => ["required","min:4","max:50","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"],
                    "nombres"           => ["required","min:4","max:50","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"],
                    "tipo_documento_id" => ["required","integer","min:1", "exists:tipos_documentos,id"],
                    "documento_nro"     => ["required","unique:usuarios,documento_nro","integer","min:6","max:99999999"],
                    "email"             => ["required",'email:rfc,dns',"min:12","max:50"]
                ];

                // Validar campos y manejar errores
                $validator = Validator::make($request->all(), $rules);

                // Manejar los errores de validación
                if($validator->fails())
                    return response()->json(['success' => false, 'errors' => $validator->errors()], 422);

                // Validación OK
                return response()->json(['success' => true]);

                break;
            }

            case('2'):
            {
                $rules = [
                    "apellidos"         => ["required","min:4","max:50","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"],
                    "nombres"           => ["required","min:4","max:50","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"],
                    "tipo_documento_id" => ["required","integer","min:1", "exists:tipos_documentos,id"],
                    "documento_nro"     => ["required","unique:usuarios,documento_nro","integer","min:6","max:99999999"],
                    "email"             => ["required",'email:rfc,dns',"min:12","max:50"],
                    "username"          => ["required","unique:usuarios,username","min:5","max:16","regex:#^[a-zA-Z0-9]*$#"],
                    "password"          => ["required","min:8","max:16"],
                    "password_repeat"   => ["same:password"],
                ];

                // Validar campos y manejar errores
                $validator = Validator::make($request->all(), $rules);

                // Manejar los errores de validación
                if($validator->fails())
                    return response()->json(['success' => false, 'errors' => $validator->errors()], 422);

                $usuario = Usuario::make($request->all());
                $usuario->token_verificacion_email = Str::random(32);
                $usuario->save();
    
                if($request->input("check_suscribe"))
                {
                    $newsletter = new Newsletter;
                    $newsletter->suscribe($usuario->email);
                }
    
                Mail::to($usuario->email)->send(new SignUp($usuario->apellidos, $usuario->nombres, "http://ecommerce.dell/shop/activate/" . $usuario->token_verificacion_email));

                // Validación OK
                return response()->json(['success' => true]);

                break;
            }
        }

        return response()->json(['success' => false]);
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function recovery(Request $request)
	{
        if($request->filled("email") && $request->filled("telefono_celular"))
        {
            $telefono   = $request->input("telefono_celular");
            $email      = strtolower($request->input("email"));

            $usuario = Usuario::where("email", $email)->where("telefono_celular", $telefono)->first();

            if($usuario)
            {
                Mail::to($usuario->email)->send(new Recovery($usuario->apellidos, $usuario->nombres));

                return redirect()->route("user.login")->with("success", "Se ha enviado un correo a su casilla de correos");
            }
            else
            {
                return redirect()->back()->withErrors(trans("auth.failed"));
            }
        }

        return view("shop.recovery", ["success" => 0]);
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function login(UserLoginRequest $request, FavoritosService $favoritosService)
	{
        // Almacena usuario y contraseña despues de la validación
        $credentials = $request->getCredentials();

        if(!Auth::attempt($credentials, $request->input("check_remember")))
            return redirect()->back()->withErrors(trans("auth.failed"));

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Verifica si la cuenta de usuario se encuentra verificada
        if($user->alta == NULL)
        {
            Auth::logout();
            return redirect()->back()->withErrors(trans("auth.unconfirmed"));
        }

        // Carga los datos del usuario en sesión
        session()->put("shop.usuario.datos", $user->toArray());

        $favoritosService->load($user->id);

        if(Newsletter::where('email', session("shop.usuario.datos.email"))->count())
            session()->put("shop.newsletter", session("shop.usuario.datos.email"));

        return redirect()->intended("shop");
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function modalLogin(UserLoginRequest $request, FavoritosService $favoritosService)
	{
        $credentials = $request->getCredentials();

        if(!Auth::attempt($credentials, $request->input("check_remember")))
        {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }
        else
        {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            // Carga los datos del usuario en sesión
            session()->put("shop.usuario.datos", $user->toArray());

            $favoritosService->load($user->id);

            if(Newsletter::where('email', session("shop.usuario.datos.email"))->count())
                session()->put("shop.newsletter", session("shop.usuario.datos.email"));

            return response()->json(['message' => 'Inicio de sesión rápido exitoso'], 200);
        }
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function loginGuest()
    {
        session()->put("shop.usuario.datos.id", -1);
        session()->put("shop.usuario.datos.username", 'invitado');

        return redirect()->intended("shop");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function logout()
    {
        Auth::logout();
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
