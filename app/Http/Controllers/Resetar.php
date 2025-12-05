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
            session([
                "alerta_resultado" => [
                    "titulo" => "Erro ao Resetar!",
                    "texto" => "Ocorreu um erro ao tentar resetar as vitórias! Tente novamente.",
                    "icone" => "bi-hand-thumbs-down-fill"
                ]
            ]);

            return redirect()->back();
        } else {
            session([
                "alerta_resultado" => [
                    "titulo" => "Vitórias Resetadas com Sucesso!",
                    "texto" => "Histórico de vitórias limpado com êxito.",
                    "icone" => "bi-hand-thumbs-up-fill"
                ]
            ]);

            return redirect()->back();
        }
    }

    public function resetarDerrotas() {
        
        $player = session("player.usuario");
        $derrotas = Batalha::where("perdeu", $player);

        $derrotas->forceDelete();

        if (!$derrotas) {
            session([
                "alerta_resultado" => [
                    "titulo" => "Erro ao Resetar!",
                    "texto" => "Ocorreu um erro ao tentar resetar as derrotas! Tente novamente.",
                    "icone" => "bi-hand-thumbs-down-fill"
                ]
            ]);

            return redirect()->back();
        } else {
            session([
                "alerta_resultado" => [
                    "titulo" => "Derrotas Resetadas com Sucesso!",
                    "texto" => "Histórico de derrotas limpado com êxito.",
                    "icone" => "bi-hand-thumbs-up-fill"
                ]
            ]);

            return redirect()->back();
        }
    }
}
