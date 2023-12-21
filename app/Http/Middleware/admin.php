<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class admin
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        // on verifie que l'utilisateur est administrateur
        if (Auth::check() && Auth::user()->admin()) {
            return $next($request);
        }
        return redirect('/home')->with('error', 'Accès interdit. Vous n\'êtes pas administrateur.');
    }
}
