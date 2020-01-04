<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Autenticador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //checagem feita antes da chamada do controller
        if (!$request->is('entrar', 'registrar') && !Auth::check()) {
            return redirect()->route('entrar');
        }
        return $next($request);
    }
}
