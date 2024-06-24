<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Models\Usuario;

use App\Mail\Welcome;

class MailController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function VerifyEmail($token = NULL)
    {
        if($token)
        {
            $usuario = Usuario::where('token_verificacion_email', $token)->first();

            if($usuario)
            {
                $usuario->update([
                    'estado'                    => 1,
                    'alta'                      => now(),
                    'token_verificacion_email'  => NULL
                ]);
                
                Mail::to($usuario->email)->send(new Welcome($usuario->apellidos, $usuario->nombres));

                return view('shop.confirmation');
            }

            return redirect("/shop")->with(trans("auth.invalid_token"));
        }

        return redirect("/shop")->with(trans("auth.empty_token"));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}