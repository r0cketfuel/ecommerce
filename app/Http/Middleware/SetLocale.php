<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(session()->has('locale'))
        {
            $locale = session('locale');
        }
        else
        {
            $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
            
            switch ($locale)
            {
                case "es": { $locale = "es_AR"; break; }
                case "en": { $locale = "en_US"; break; }
            }
        }

        App()->setLocale($locale);

        return $next($request);
    }
}
