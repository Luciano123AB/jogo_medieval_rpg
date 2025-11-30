<?php

namespace App\Http\Controllers;

use App\Models\Batalha;
use App\Models\Personagem;
use App\Models\Player;
use App\Services\Randoms;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Batalhar extends Controller
{
    public function confirmarBatalha(Request $request): RedirectResponse {
        $request->validate(
            [
                "oponente" => "required|exists:personagems,id"
            ],

            [
                "oponente.required" => "Você deve escolher o seu oponente primeiro."
            ]
        );

        $id = $request->oponente;

        session([
            "alerta_confirmar" => [
                "titulo" => "Confirmar Batalha!",
                "texto" => "Tem certeza que está pronto para ir para a batalha?",
                "cancelar" => "cancelarBatalha",
                "sim" => "batalhar"
            ]
        ]);

        session([
            "id_oponente" => $id,
            "foto_oponente" => "nenhuma",
            "nome_oponente" => "Computador"
        ]);

        return redirect()->back()->withInput();
    }

    public function confirmarDesafio($player, $oponente, $nome_oponente, $nivel): RedirectResponse {
        if ($nivel > session("player.nivel")) {
            session([
                "alerta_resultado" => [
                    "titulo" => "Player Muito Forte!",
                    "texto" => "Você não pode desafiar um player de nível superior que o seu. Escolha outro.",
                    "icone" => "bi-hand-thumbs-down-fill"
                ],
            ]);

            return redirect()->back();
        } elseif ($nivel < session("player.nivel")) {
            session([
                "alerta_resultado" => [
                    "titulo" => "Player Muito Fraco!",
                    "texto" => "Você não pode desafiar um player de nível inferior que o seu. Escolha outro.",
                    "icone" => "bi-hand-thumbs-down-fill"
                ],
            ]);

            return redirect()->back();
        }

        session([
            "alerta_confirmar" => [
                "titulo" => "Confirmar Desafio!",
                "texto" => "Tem certeza que deseja desafiar este player?",
                "cancelar" => "cancelarBatalha",
                "sim" => "batalhar"
            ]
        ]);

        $foto_oponente = Player::find($player)->foto;
        $pais_oponente = Player::find($player)->pais;

        session([
            "id_player" => $player,
            "id_oponente" => $oponente,
            "foto_oponente" => $foto_oponente,
            "pais_oponente" => $pais_oponente,
            "nome_oponente" => $nome_oponente,
            "nivel_oponente" => $nivel
        ]);

        return redirect()->back();
    }

    public function cancelar(): RedirectResponse {
        session()->forget(["alerta_confirmar", "id_oponente", "nome_oponente", "nivel_oponente"]);

        return redirect()->back();
    }

    public function atacar(Request $request): RedirectResponse {

        $skill_escolhida = $request->input("btnradio");

        if (!$skill_escolhida) {
            return redirect()->back()->withErrors(["skill" => "Escolha sua skill primeiro."]);
        }

        $id_batalha = session("dados.id_batalha");
        $id = session("player.personagem.id");
        $personagem = Personagem::find($id);       
        $nivel = session("player.nivel");
        
        $dano = Randoms::danoPlayerSorteado($personagem, $nivel, $skill_escolhida);

        if (session()->has(["skill01", "skill02", "skill03"])) {
            session()->forget(["skill01", "skill02", "skill03"]);
        }

        $batalha = Batalha::find($id_batalha);
        $batalha->hp_oponente = $batalha->hp_oponente - $dano;
        $batalha->vez = 1;
        $batalha->save();

        return redirect()->back()
            ->with("dano_desferido_player", $dano)
            ->with("dano_recebido_oponente", true);
    }

    public function ataqueOponente(): RedirectResponse {

        $id_batalha = session("dados.id_batalha");
        $id = session("dados.id_oponente");
        $personagem = Personagem::find($id);
        $nivel = null;

        if (session()->has("nivel_oponente")) {
            $nivel = session("nivel_oponente");            
        } else {
            $nivel = session("player.nivel");
        }
              
        $dano = Randoms::danoOponenteSorteado($personagem, $nivel);
        
        $batalha = Batalha::find($id_batalha);
        $batalha->hp = $batalha->hp - $dano;
        $batalha->vez = 0;
        $batalha->save();

        return redirect()->back()
            ->with("dano_desferido_oponente", $dano)
            ->with("dano_recebido_player", true);
    }

    public function confirmarRender(): RedirectResponse {
        session([
            "alerta_confirmar_render" => [
                "titulo" => "Confirmar Rendição!",
                "texto" => "Tem certeza que deseja desistir dessa batalha?",
                "cancelar" => "cancelarRender",
                "sim" => "renderSe"
            ]
        ]);

        return redirect()->back();
    }

    public function cancelarRender(): RedirectResponse {
        session()->forget("alerta_confirmar_render");

        return redirect()->back();
    }

    public function renderSe(): RedirectResponse {

        $id_batalha = session("dados.id_batalha");

        $batalha = Batalha::find($id_batalha);
        if (session("nome_oponente") == "Computador") {
            $batalha->ganhou = "Computador";
            $batalha->perdeu = session("player.usuario");
        } else {
            $batalha->ganhou = session("nome_oponente");
            $batalha->perdeu = session("player.usuario");
        }
        $batalha->updated_at = date("Y-m-d H:i:s");
        $batalha->save();
        $batalha->delete();

        session()->forget(["alerta_confirmar_render", "id_oponente", "foto_oponente", "bandeira_oponente", "nivel_oponente", "dados", "skill01", "skill02", "skill03"]);

        $id = session("player.id");
        
        $player = Player::find($id);
        $player->quantidade_derrotas = $player->quantidade_derrotas + 1;
        $player->save();

        if (session()->has("id_player")) {
            $id = session("id_player");

            $player = Player::find($id);
            $player->quantidade_vitorias = $player->quantidade_vitorias + 1;
            $player->save();
        }
        
        session([
            "alerta_batalha" => [
                "titulo" => "Derrota!",
                "texto" => "Que Pena! Mas não desista, faz parte, infelismente não dá para ganhar todas, continue tentando.",
                "icone" => "bi-emoji-frown-fill",
                "rota" => ""
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
