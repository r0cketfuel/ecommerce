<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\InfoComercio;
use App\Models\Sucursal;
use App\Models\Visita;
use App\Models\Marquesina;

class LoadInfoComercio
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has("infoComercio"))
        {
            $this->registrarVisita($request);

            Session()->put("infoComercio",            InfoComercio::first()->toArray());
            Session()->put("infoComercio.sucursales", Sucursal::all()->toArray());
            Session()->put("shop.marquesinas",        Marquesina::vigentes());
            Session()->put("shop.newsletter",         array());
        }

        return $next($request);
    }
    
    /**
     * Registra la visita en la tabla de visitas.
     */
    private function registrarVisita(Request $request)
    {
        $visita         = new Visita();
        $visita->ip     = $request->ip();
        $visita->fecha  = now();
        
        if(strlen($visita->ip)<=15)
            $visita->save();
    }
}
