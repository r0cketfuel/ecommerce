<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ExtendAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // El usuario está autenticado, permite el acceso normalmente.
            return $next($request);
        }

        // Comprueba si hay una sesión de invitados y, en ese caso, permite el acceso.
        if (session('shop.usuario.datos.id') == -1) {
            return $next($request);
        }

        // Usuario no autenticado ni invitado, redirige al inicio de sesión.
        return redirect()->route('user.login');
    }
}
