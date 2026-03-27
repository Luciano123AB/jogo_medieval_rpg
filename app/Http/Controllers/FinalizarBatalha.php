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
        $nome_oponente = $batalha->nome_oponente;

        if (session("nome_oponente") == "Computador") {
            $xp = 200 + random_int(1, 50);
        } else {
            $xp = 300 + random_int(1, 50);
        }

        Salvar::vitoria($player, $xp, $batalha);

        session()->forget([
            "id_player",
            "id_oponente",
            "id_batalha",
            "inicio_player",
            "inicio_oponente",
            "batalha_comecou"
        ]);

        if ($player->nivel > Auth::user()->nivel) {

            $rota = route("nivel");

        }
        
        session()->flash("vitoria", true);
        $this->alertaBatalha("Vitória!", "Parabéns!, continue assim e você se destacará na classificação. $xp" . "xp", "bi-emoji-sunglasses-fill", $rota ?? "");

        if ($nome_oponente == "Computador") {
            return redirect()->route("preparacao");
        }

        return redirect()->route("listagem");
    }

    public function finalizarDerrota(Batalha $batalha): RedirectResponse {

        $player = Player::findOrFail(Auth::user()->id);
        $nome_oponente = $batalha->nome_oponente;

        Salvar::derrota($player, $batalha);

        session()->forget([
            "id_player",
            "id_oponente",
            "id_batalha",
            "inicio_player",
            "inicio_oponente",
            "batalha_comecou"
        ]);        
        session()->flash("derrota", true);
        $this->alertaBatalha("Derrota!", "Que Pena! Mas não desista, faz parte, infelismente não dá para ganhar todas, continue tentando.", "bi-emoji-frown-fill", "");

        if ($nome_oponente == "Computador") {
            return redirect()->route("preparacao");
        }

        return redirect()->route("listagem");
    }
}