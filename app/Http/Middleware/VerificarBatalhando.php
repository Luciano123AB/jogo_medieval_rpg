<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarBatalhando extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has("batalha_comecou")) {
            $this->alertaResultado("Fora da Batalha!", "Espere! Para usar essa rota, antes você precisa começar uma batalha.", "bi-hand-thumbs-down-fill");

            return redirect()->back();
        }

        return $next($request);
    }
}
