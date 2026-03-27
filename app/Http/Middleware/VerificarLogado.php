<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerificarLogado extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::user()) {
            $this->alertaResultado("Acesso Negado!", "Para poder abrir essa página, primeiro você deve logar na sua conta.", "bi-hand-thumbs-down-fill");

            return redirect()->route("/");
        }

        return $next($request);
    }
}
