<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarBatalha extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has("dados.batalha_comecou")) {
            $this->alertaResultado("Batalha em Andamento!", "Espere! Para sair, antes você precisa finalizar essa batalha.", "bi-hand-thumbs-down-fill");

            return redirect()->back();
        }

        return $next($request);
    }
}
