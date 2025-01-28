<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PermissoesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $rotasPermitidas = Auth::user()->permissoes->pluck('rota')->map(function ($rota) {
            return implode('/', array_slice(explode('/', $rota), 0, 2)) . '/';
        });

        
        $rotaAtual = implode('/', array_slice(explode('/', $request->path()), 0, 2)) . '/';

        foreach ($rotasPermitidas as $rota) {

            if (str_starts_with($rotaAtual, $rota)) {
                return $next($request);
            }
        }

        abort(403, 'Acesso não autorizado');
    }
}
