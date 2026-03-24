<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Batalha;
use App\Models\Player;
use App\Services\Salvar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

Class FinalizarBatalha extends Controller
{
    public function finalizarVitoria(Batalha $batalha): RedirectResponse {

        $player = Player::findOrFail(Auth::user()->id);

        if (session("nome_oponente") == "Computador") {
            $xp = 200 + random_int(1, 50);
        } else {
            $xp = 300 + random_int(1, 50);
        }

        Salvar::vitoria($player, $xp, $batalha);

        session()->forget([
            "inicio_player", "inicio_oponente",
            "skill01", "skill02", "skill03", "skill01_oponente", "skill02_oponente", "skill03_oponente",
            "id_oponente", "foto_oponente", "bandeira_oponente", "nivel_oponente", "dados"
        ]);

        $rota = "";

        session()->forget("id_player");

        if ($player->nivel > Auth::user()->nivel) {
            $rota = route('nivel');
        }
        
        session()->flash("vitoria", true);
        $this->alertaBatalha("Vitória!", "Parabéns!, continue assim e você se destacará na classificação. $xp" . "xp", "bi-emoji-sunglasses-fill", $rota);

        if (session("nome_oponente") == "Computador") {
            session()->forget("nome_oponente");

            return redirect()->route("preparacao");
        }

        session()->forget("nome_oponente");

        return redirect()->route("listagem");
    }

    public function finalizarDerrota(Batalha $batalha): RedirectResponse {

        $player = Player::findOrFail(Auth::user()->id);

        Salvar::derrota($player, $batalha);

        session()->forget([
            "inicio_player", "inicio_oponente",
            "skill01", "skill02", "skill03", "skill01_oponente", "skill02_oponente", "skill03_oponente",
            "id_oponente", "foto_oponente", "bandeira_oponente", "nivel_oponente", "dados"
        ]);
        
        session()->flash("derrota", true);
        $this->alertaBatalha("Derrota!", "Que Pena! Mas não desista, faz parte, infelismente não dá para ganhar todas, continue tentando.", "bi-emoji-frown-fill", "");

        if (session("nome_oponente") == "Computador") {
            session()->forget(["id_player", "nome_oponente"]);

            return redirect()->route("preparacao");
        }
        
        session()->forget(["id_player", "nome_oponente"]);

        return redirect()->route("listagem");
    }
}