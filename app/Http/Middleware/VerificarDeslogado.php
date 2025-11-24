<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarDeslogado
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has("player")) {
            session([
                "alerta_resultado" => [
                    "titulo" => "Acesso Negado!",
                    "texto" => "Para poder abrir essa página, primeiro você deve deslogar da sua conta.",
                    "icone" => "bi-hand-thumbs-down-fill"
                ],
            ]);

            return redirect()->back();
        }

        return $next($request);
    }
}
