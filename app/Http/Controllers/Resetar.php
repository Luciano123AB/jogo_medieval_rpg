<?php

namespace App\Http\Controllers;

use App\Models\Batalha;

class Resetar extends Controller
{
    public function resetarVitorias() {

        $player = session("player.usuario");
        $vitorias = Batalha::where("ganhou", $player);

        $vitorias->forceDelete();

        if (!$vitorias) {
            $this->alertaResultado("Erro ao Resetar!", "Ocorreu um erro ao tentar resetar as vitórias! Tente novamente.", "bi-hand-thumbs-down-fill");

            return redirect()->back();
        } else {
            $this->alertaResultado("Vitórias Resetadas com Sucesso!", "Histórico de vitórias limpado com êxito.", "bi-hand-thumbs-up-fill");

            return redirect()->back();
        }
    }

    public function resetarDerrotas() {
        
        $player = session("player.usuario");
        $derrotas = Batalha::where("perdeu", $player);

        $derrotas->forceDelete();

        if (!$derrotas) {
            $this->alertaResultado("Erro ao Resetar!", "Ocorreu um erro ao tentar resetar as derrotas! Tente novamente.", "bi-hand-thumbs-down-fill");

            return redirect()->back();
        } else {
            $this->alertaResultado("Derrotas Resetadas com Sucesso!", "Histórico de derrotas limpado com êxito.", "bi-hand-thumbs-up-fill");

            return redirect()->back();
        }
    }
}
