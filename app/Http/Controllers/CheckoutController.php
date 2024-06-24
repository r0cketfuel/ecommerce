<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Services\ShoppingCartService;

use App\Models\MedioPago;
use App\Models\MedioEnvio;
use App\Models\TipoDocumento;

class CheckoutController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function checkout(ShoppingCartService $shoppingCart, Request $request)
	{
        $checkout = $shoppingCart->checkOut();

        if($request->isMethod("post"))
        {
            $currentStep = (int)$request->input("currentStep");

            switch($currentStep)
            {
                case(1):
                {
                    session()->put("shop.checkout.confirmation", now());
                    session()->put("shop.checkout.total", $checkout["total"]);

                    return response()->json(['success' => true]);
                    
                    break;
                }

                case(2):
                {
                    $rules = [
                        "apellidos"         => ["required","alpha","min:4","max:50"],
                        "nombres"           => ["required","alpha","min:4","max:50"],
                        "documento_nro"     => ["required","integer","between:1000000,99999999",'regex:/^\d{7,8}$/'],
                        "telefono_celular"  => ["required","integer","between:1000000000,999999999999999",'regex:/^\d{10,15}$/'],
                        "telefono_alt"      => ["nullable","integer","between:1000000000,999999999999999",'regex:/^\d{10,15}$/'],
                        "email"             => ["required",'email:rfc,dns',"min:12","max:50"],
                    ];

                    // Validar campos y manejar errores
                    $validator = Validator::make($request->all(), $rules);

                    // Manejar los errores de validación
                    if($validator->fails())
                        return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
                    
                        $keys = ["apellidos", "nombres", "documento_nro", "telefono_celular", "telefono_alt", "email"];
                        
                        // Guardar los datos validados en la sesión
                        foreach ($keys as $key)
                            session()->put("shop.checkout.datos.$key", $validator->valid()[$key]);

                    return response()->json(['success' => true]);
                    
                    break;
                }

                case(3):
                {
                    $rules = [
                        "radio_medioPago"   => ["required","exists:medios_pagos,id"],
                        "radio_medioEnvio"  => ["required","exists:medios_envios,id"],
                    ];

                    // Validar campos y manejar errores
                    $validator = Validator::make($request->all(), $rules);

                    // Manejar los errores de validación
                    if($validator->fails())
                        return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
                    
                    // Información sobre el medio de pago seleccionado
                    $medioPagoSeleccionado = MedioPago::find($request->input('radio_medioPago'));
                    session()->put("shop.checkout.medio_pago", $medioPagoSeleccionado->toArray());

                    // Información sobre el medio de envío seleccionado
                    $medioEnvioSeleccionado = MedioEnvio::find($request->input('radio_medioEnvio'));
                    session()->put("shop.checkout.medio_envio", $medioEnvioSeleccionado->toArray());

                    // Si el usuario ha seleccionado envío, aplicar reglas de validación adicionales
                    if($medioEnvioSeleccionado->id != 1)
                    {
                        // Definir las reglas de validación adicionales
                        $rules = [
                            "codigo_postal"             => ["required","numeric", "between:1000,9999"],
                            "localidad"                 => ["required","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"],
                            "domicilio"                 => ["required","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"],
                            "domicilio_nro"             => ["required","numeric", "min:1","max:99999"],
                            "domicilio_piso"            => ["nullable"],
                            "domicilio_depto"           => ["nullable"],
                            "domicilio_aclaraciones"    => ["nullable"],
                        ];
                    }

                    // Validar campos y manejar errores
                    $validator = Validator::make($request->all(), $rules);

                    // Manejar los errores de validación
                    if($validator->fails())
                        return response()->json(['success' => false, 'errors' => $validator->errors()], 422);

                    if($medioEnvioSeleccionado->id != 1)
                    {
                        $keys = ["codigo_postal", "localidad", "domicilio", "domicilio_nro", "domicilio_piso", "domicilio_depto", "domicilio_aclaraciones"];
                        
                        foreach ($keys as $key)
                            if($request->has($key))
                                session()->put("shop.checkout.envio.$key", $request->input($key));
                    }

                    return response()->json(['success' => true]);

                    break;
                }

                case(4):
                {
                    return response()->json(['success' => true]);

                    break;
                }

                case(5):
                {
                    break;
                }
            }
        }

        if($shoppingCart->totalItems() > 0)
        {
            $tiposDocumentos    = TipoDocumento::all();
            $mediosPago         = MedioPago::all();
            $mediosEnvio        = MedioEnvio::all();
        
            return view("shop.checkout.index", compact("checkout", "mediosPago", "mediosEnvio", "tiposDocumentos"));
        }
        
        return view("shop.checkout.index", compact("checkout"));
	}
}
