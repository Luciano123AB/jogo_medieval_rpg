<?php

namespace App\Http\Controllers;

use App\Models\Batalha;
use App\Models\Personagem;
use App\Models\Player;
use App\Services\Randoms;
use App\Services\Salvar;
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

        $this->alertaConfirmar("Confirmar Batalha!", "Tem certeza que está pronto para ir para a batalha?", "batalhar");
        session([
            "id_oponente" => $id,
            "foto_oponente" => "nenhuma",
            "nome_oponente" => "Computador"
        ]);

        return redirect()->back()->withInput();
    }

    public function confirmarDesafio($player, $oponente, $nome_oponente, $nivel): RedirectResponse {
        if ($nivel > session("player.nivel")) {
            $this->alertaResultado("Player Muito Forte!", "Você não pode desafiar um player de nível superior que o seu. Escolha outro.", "bi-hand-thumbs-down-fill");

            return redirect()->back();
        } elseif ($nivel < session("player.nivel")) {
            $this->alertaResultado("Player Muito Fraco!", "Você não pode desafiar um player de nível inferior que o seu. Escolha outro.", "bi-hand-thumbs-down-fill");

            return redirect()->back();
        }
        
        $this->alertaConfirmar("Confirmar Desafio!", "Tem certeza que deseja desafiar este player?", "batalhar");

        $dados_oponente = Player::find($player);
        $foto_oponente = $dados_oponente->foto;
        $pais_oponente = $dados_oponente->pais;

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
        $salvar_batalha = Salvar::atacar($batalha, $dano);

        if (!$salvar_batalha) {
            $this->alertaResultado("Erro ao Atacar!", "Ocorreu um erro ao tentar atacar o oponente! Tente novamente.", "bi-hand-thumbs-down-fill");

            return redirect()->back();
        }

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
        $salvar_batalha = Salvar::ataqueOponente($batalha, $dano);

        if (!$salvar_batalha) {
            $this->alertaResultado("Erro ao Receber Ataque!", "Ocorreu um erro ao receber o ataque do oponente!", "bi-hand-thumbs-down-fill");

            return redirect()->back();
        }

        return redirect()->back()
            ->with("dano_desferido_oponente", $dano)
            ->with("dano_recebido_player", true);
    }

    public function confirmarRender(): RedirectResponse {
        $this->alertaConfirmarRender("Confirmar Rendição!", "Tem certeza que deseja desistir dessa batalha?", "renderSe");

        return redirect()->back();
    }

    public function renderSe(): RedirectResponse {
        session()->forget([
            "inicio_player", "inicio_oponente",
            "skill01", "skill02", "skill03", "skill01_oponente", "skill02_oponente", "skill03_oponente",
            "id_oponente", "foto_oponente", "bandeira_oponente", "nivel_oponente"
        ]);

        $id = session("player.id");
        $player = Player::find($id);
        $id_batalha = session("dados.id_batalha");
        $batalha = Batalha::find($id_batalha);

        Salvar::render($player, $batalha);

        session()->forget(["id_player", "dados"]);
        session()->flash("derrota", true);
        $this->alertaBatalha("Derrota!", "Que Pena! Mas não desista, faz parte, infelismente não dá para ganhar todas, continue tentando.", "bi-emoji-frown-fill", "");

        if (session("nome_oponente") == "Computador") {
            session()->forget("nome_oponente");

            return redirect()->route("preparacao");
        }
        
        session()->forget("nome_oponente");

        return redirect()->route("listagem");
    }
}
