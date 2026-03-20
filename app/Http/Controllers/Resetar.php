<?php

namespace App\Http\Controllers;

use App\Models\Batalha;
use Illuminate\Http\RedirectResponse;

class Resetar extends Controller
{
    public function resetarVitorias(): RedirectResponse {

        $vitorias = Batalha::where("ganhou", session("player.usuario"));

        $vitorias->forceDelete();

        if (!$vitorias) {
            $this->alertaResultado("Erro ao Resetar!", "Ocorreu um erro ao tentar resetar as vitórias! Tente novamente.", "bi-hand-thumbs-down-fill");

            return redirect()->back();
        }

        $this->alertaResultado("Vitórias Resetadas com Sucesso!", "Histórico de vitórias limpado com êxito.", "bi-hand-thumbs-up-fill");

        return redirect()->back();
    }

    public function resetarDerrotas(): RedirectResponse {
        
        $derrotas = Batalha::where("perdeu", session("player.usuario"));

        $derrotas->forceDelete();

        if (!$derrotas) {
            $this->alertaResultado("Erro ao Resetar!", "Ocorreu um erro ao tentar resetar as derrotas! Tente novamente.", "bi-hand-thumbs-down-fill");

            return redirect()->back();
        }

        $this->alertaResultado("Derrotas Resetadas com Sucesso!", "Histórico de derrotas limpado com êxito.", "bi-hand-thumbs-up-fill");

        return redirect()->back();
    }
}
