<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
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
        if (session()->has("dados.batalha_comecou")) {

            $id_batalha = session("dados.id_batalha");
            $batalha = Batalha::find($id_batalha);

            if (!$batalha) {
                $this->alertaResultado("Erro ao Batalhar!", "Ocorreu um erro ao tentar começar a batalha! Tente novamente.", "bi-hand-thumbs-down-fill");
                session()->forget([
                    "inicio_player", "inicio_oponente",
                    "id_oponente", "foto_oponente", "bandeira_oponente", "nivel_oponente", "dados"
                ]);
                
                if (session("nome_oponente") == "Computador") {
                    session()->forget(["id_player", "nome_oponente"]);

                    return redirect()->route("preparacao");
                } else {
                    session()->forget(["id_player", "nome_oponente"]);

                    return redirect()->route("listagem");
                }
            } else {
                if ($batalha->hp <= 0) {
                    return redirect()->route("derrota", ["batalha" => $batalha]);
                }
                if ($batalha->hp_oponente <= 0) {
                    return redirect()->route("vitoria", ["batalha" => $batalha]);
                }
            }
        }

        return $next($request);
    }
}
