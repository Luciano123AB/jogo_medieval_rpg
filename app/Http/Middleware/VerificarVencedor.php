<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FinalizarBatalha;
use App\Models\Batalha;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarVencedor extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has("batalha_comecou")) {

            $batalha = Batalha::find(session("id_batalha"));
            $nome_oponente = $batalha->nome_oponente;

            if (!$batalha) {
                $this->alertaResultado("Erro ao Batalhar!", "Ocorreu um erro ao tentar começar a batalha! Tente novamente.", "bi-hand-thumbs-down-fill");
                session()->forget([
                    "id_player",
                    "id_oponente",
                    "id_batalha",
                    "batalha_comecou"
                ]);
                
                if ($nome_oponente == "Computador") {
                    return redirect()->route("preparacao");
                }

                return redirect()->route("listagem");                
            } else {
                if ($batalha->hp <= 0) {
                    return app(FinalizarBatalha::class)->finalizarDerrota($batalha);
                }

                if ($batalha->hp_oponente <= 0) {
                    return app(FinalizarBatalha::class)->finalizarVitoria($batalha);
                }
            }
        }

        return $next($request);
    }
}