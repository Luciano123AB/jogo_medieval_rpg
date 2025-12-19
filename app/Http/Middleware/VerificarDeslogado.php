<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarDeslogado extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has("player")) {
            $this->alertaResultado("Acesso Negado!", "Para poder abrir essa página, primeiro você deve deslogar da sua conta.", "bi-hand-thumbs-down-fill");

            return redirect()->back();
        }

        return $next($request);
    }
}
