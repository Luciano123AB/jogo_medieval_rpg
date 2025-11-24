<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarBatalha
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has("dados.batalha_comecou")) {
            session([
                "alerta_operacao" => [
                    "titulo" => "Batalha em Andamento!",
                    "texto" => "Para sair, antes você precisa finalizar essa batalha."
                ],
            ]);

            return redirect()->back();
        }

        return $next($request);
    }
}
