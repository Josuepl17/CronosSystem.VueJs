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
        $rotasPermitidas = Auth::user()->permissoes->pluck('rota');
       // dd($rotasPermitidas);
        $rotaAtual = $request->path();

        foreach ($rotasPermitidas as $rota) {
            if ($rota === $rotaAtual) {
                return $next($request);
            }
        }

        abort(403, 'Acesso não autorizado');
    }
}
