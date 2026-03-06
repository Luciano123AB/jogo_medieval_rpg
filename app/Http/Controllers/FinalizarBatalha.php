<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Batalha;
use App\Models\Player;
use App\Services\Salvar;
use Illuminate\Http\RedirectResponse;

Class FinalizarBatalha extends Controller
{
    public function finalizarVitoria(Batalha $batalha): RedirectResponse {
        session()->forget([
            "inicio_player", "inicio_oponente",
            "skill01", "skill02", "skill03", "skill01_oponente", "skill02_oponente", "skill03_oponente",
            "alerta_confirmar_render", "id_oponente", "foto_oponente", "bandeira_oponente", "nivel_oponente", "dados"
        ]);

        $id = session("player.id");
        $rota = "";
        $xp = 00.0;

        if (session("nome_oponente") == "Computador") {
            $xp = 25.0;
        } else {
            $xp = 33.5;
        }
        
        $player = Player::find($id);

        if ($player->xp >= 100) {
            $rota = route('home');
        }

        Salvar::vitoria($player, $xp, $batalha);

        session(["xp" => $player->xp]);
        session()->forget("id_player");

        if ($xp == 25.0) {
            $xp_ganho = "+250xp";
        } else {
            $xp_ganho = "+335xp";
        }
        
        session(["vitoria" => true]);
        $this->alertaBatalha("Vitória!", "Parabéns!, continue assim e você se destacará na classificação. $xp_ganho", "bi-emoji-sunglasses-fill", $rota);

        if (session("nome_oponente") == "Computador") {
            session()->forget("nome_oponente");

            return redirect()->route("preparacao");
        }

        session()->forget("nome_oponente");

        return redirect()->route("listagem");
    }

    public function finalizarDerrota(Batalha $batalha): RedirectResponse {
        session()->forget([
            "inicio_player", "inicio_oponente",
            "skill01", "skill02", "skill03", "skill01_oponente", "skill02_oponente", "skill03_oponente",
            "alerta_confirmar_render", "id_oponente", "foto_oponente", "bandeira_oponente", "nivel_oponente", "dados"
        ]);

        $id = session("player.id");        
        $player = Player::find($id);

        Salvar::derrota($player, $batalha);
        
        session(["derrota" => true]);
        $this->alertaBatalha("Derrota!", "Que Pena! Mas não desista, faz parte, infelismente não dá para ganhar todas, continue tentando.", "bi-emoji-frown-fill", "");

        if (session("nome_oponente") == "Computador") {
            session()->forget(["id_player", "nome_oponente"]);

            return redirect()->route("preparacao");
        }
        
        session()->forget(["id_player", "nome_oponente"]);

        return redirect()->route("listagem");
    }
}