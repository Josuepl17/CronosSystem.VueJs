<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthMiddleware
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
        // Verifica se o usuário está autenticado
        if (!Auth::check()) {
            // Redireciona para a página de login se não estiver autenticado
            return redirect()->route('logi');
        }

            Session::put('funcionario_id', Auth::id());
        

        return $next($request);
    }
}
