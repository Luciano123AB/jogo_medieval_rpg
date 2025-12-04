<?php

namespace App\Http\Middleware;

use App\Models\Batalha;
use App\Models\Player;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarVencedor
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
            
            if ($batalha->hp <= 0) {
                session()->forget(["inicio_player", "inicio_oponente"]);
                session()->forget(["skill01", "skill02", "skill03", "skill01_oponente", "skill02_oponente", "skill03_oponente"]);
                session()->forget(["alerta_confirmar_render", "id_oponente", "foto_oponente", "bandeira_oponente", "nivel_oponente", "dados"]);
    
                $id = session("player.id");                
                
                $player = Player::find($id);
                $player->quantidade_derrotas = $player->quantidade_derrotas + 1;
                $player->save();

                if (session()->has("id_player")) {

                    $id = session("id_player");

                    $player = Player::find($id);
                    $player->quantidade_vitorias = $player->quantidade_vitorias + 1;
                    $player->save();

                    $batalha->ganhou = $player->usuario;
                    $batalha->perdeu = session("player.usuario");
                }
                
                if (session("nome_oponente") == "Computador") {

                    $batalha->ganhou = "Computador";
                    $batalha->perdeu = session("player.usuario");

                }
                $batalha->updated_at = date("Y-m-d H:i:s");
                $batalha->save();
                $batalha->delete();
                
                session([
                    "alerta_batalha" => [
                        "titulo" => "Derrota!",
                        "texto" => "Que Pena! Mas não desista, faz parte, infelismente não dá para ganhar todas, continue tentando.",
                        "icone" => "bi-emoji-frown-fill",
                        "rota" => ""
                    ]
                ]);
    
                if (session("nome_oponente") == "Computador") {
                    session()->forget(["id_player", "nome_oponente"]);

                    return redirect()->route("preparacao");
                } else {
                    session()->forget(["id_player", "nome_oponente"]);

                    return redirect()->route("listagem");
                }                
            }
            
            if ($batalha->hp_oponente <= 0) {
                session()->forget(["inicio_player", "inicio_oponente"]);
                session()->forget(["skill01", "skill02", "skill03", "skill01_oponente", "skill02_oponente", "skill03_oponente"]);
                session()->forget(["alerta_confirmar_render", "id_oponente", "foto_oponente", "bandeira_oponente", "nivel_oponente", "dados"]);
    
                $id = session("player.id");
                $rota = route('listagem');
                $xp = 00.0;

                if (session("nome_oponente") == "Computador") {

                    $rota = route('preparacao');

                    $batalha->perdeu = "Computador";
                } else {

                    $batalha->perdeu = session("nome_oponente");

                }

                if (session("nome_oponente") == "Computador") {
                    $xp = 25.0;
                } else {
                    $xp = 33.5;
                }
                
                $player = Player::find($id);
                $player->xp = $player->xp + $xp;
                if ($player->xp >= 100) {
                    $player->nivel++;
                    $player->xp = 0;
                    $rota = route('home');
                }
                $player->quantidade_vitorias = $player->quantidade_vitorias + 1;
                $player->save();

                session(["xp" => $player->xp]);

                $batalha->ganhou = $player->usuario;

                if (session()->has("id_player")) {

                    $id = session("id_player");

                    $player = Player::find($id);
                    $player->quantidade_derrotas = $player->quantidade_derrotas + 1;
                    $player->save();
                }

                session()->forget(["id_player"]);
                
                $batalha->updated_at = date("Y-m-d H:i:s");
                $batalha->save();
                $batalha->delete();
                
                session([
                    "alerta_batalha" => [
                        "titulo" => "Vitória!",
                        "texto" => "Parabéns!, continue assim e você se destacará na classificação.",
                        "icone" => "bi-emoji-sunglasses-fill",
                        "rota" => $rota
                    ]
                ]);
    
                if (session("nome_oponente") == "Computador") {
                    session()->forget(["nome_oponente"]);

                    return redirect()->route("preparacao");
                } else {
                    session()->forget(["nome_oponente"]);

                    return redirect()->route("listagem");
                }
            }
        }

        return $next($request);
    }
}
