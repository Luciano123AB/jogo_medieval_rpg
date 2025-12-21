<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Batalha;
use App\Models\Player;

Class FinalizarBatalha extends Controller
{
    public function finalizarVitoria(Batalha $batalha) {
        session()->forget([
            "inicio_player", "inicio_oponente",
            "skill01", "skill02", "skill03", "skill01_oponente", "skill02_oponente", "skill03_oponente",
            "alerta_confirmar_render", "id_oponente", "foto_oponente", "bandeira_oponente", "nivel_oponente", "dados"
        ]);

        $id = session("player.id");
        $rota = "";
        $xp = 00.0;

        if (session("nome_oponente") == "Computador") {
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
        if ($player->nivel < 70) {
            $player->xp = $player->xp + $xp;
            
            if ($player->xp >= 100) {
                $player->nivel++;
                $player->xp = 0;
                $rota = route('home');
            }
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

        session()->forget("id_player");
        
        $batalha->updated_at = date("Y-m-d H:i:s");
        $batalha->save();
        $batalha->delete();

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
        } else {
            session()->forget("nome_oponente");

            return redirect()->route("listagem");
        }
    }

    public function finalizarDerrota(Batalha $batalha) {
        session()->forget([
            "inicio_player", "inicio_oponente",
            "skill01", "skill02", "skill03", "skill01_oponente", "skill02_oponente", "skill03_oponente",
            "alerta_confirmar_render", "id_oponente", "foto_oponente", "bandeira_oponente", "nivel_oponente", "dados"
        ]);

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
        
        session(["derrota" => true]);
        $this->alertaBatalha("Derrota!", "Que Pena! Mas não desista, faz parte, infelismente não dá para ganhar todas, continue tentando.", "bi-emoji-frown-fill", "");

        if (session("nome_oponente") == "Computador") {
            session()->forget(["id_player", "nome_oponente"]);

            return redirect()->route("preparacao");
        } else {
            session()->forget(["id_player", "nome_oponente"]);

            return redirect()->route("listagem");
        }
    }
}