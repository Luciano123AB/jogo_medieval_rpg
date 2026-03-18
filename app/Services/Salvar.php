<?php

namespace App\Services;

use App\Models\Player;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Salvar
{
    public static function cadastrar($novo_player) {
        $novo_player->usuario = session("dados.usuario");
        $novo_player->email = session("dados.email");
        $novo_player->senha = Hash::make(session("dados.senha"));
        $novo_player->genero = session("dados.genero");
        $novo_player->pais = session("dados.pais");
        $novo_player->foto = session("dados.foto");
        $novo_player->nivel = 1;
        $novo_player->xp = 0;
        $novo_player->quantidade_vitorias = 0;
        $novo_player->quantidade_derrotas = 0;
        $novo_player->personagem_id = session("dados.classe");
        $novo_player->created_at = date("Y-m-d H:i:s");

        $salvar = DB::transaction(function () use ($novo_player) {
            $novo_player->saveOrFail();

            return true;
        });

        return $salvar;
    }

    public static function atualizar($player) {
        
        $senha = session("dados.senha");

        $player->usuario = session("dados.usuario");
        $player->email = session("dados.email");
        $player->senha = Hash::make($senha);
        $player->personagem_id = session("dados.classe");
        $player->foto = session("dados.foto");
        $player->updated_at = date("Y-m-d H:i:s");

        $salvar = DB::transaction(function () use ($player) {
            $player->saveOrFail();

            return true;
        });

        return $salvar;
    }

    public static function batalharDesafiar($nova_batalha, $oponente, $nivel, $vez, $novo_desafio) {
        $nova_batalha->nome = session("player.usuario");
        $nova_batalha->nome_oponente = session("nome_oponente");
        $nova_batalha->hp_maximo = session("player.personagem.hp") * session("player.nivel");
        $nova_batalha->hp = session("player.personagem.hp") * session("player.nivel");
        $nova_batalha->hp_maximo_oponente = $oponente->hp * $nivel;
        $nova_batalha->hp_oponente = $oponente->hp * $nivel;
        $nova_batalha->vez = $vez;
        $nova_batalha->ganhou = null;
        $nova_batalha->perdeu = null;
        $nova_batalha->created_at = date("Y-m-d H:i:s");

        $novo_desafio->id_desafiador = session("player.id");
        $novo_desafio->id_desafiado = session("id_player");

        $salvar = DB::transaction(function () use ($nova_batalha, $novo_desafio) {
            $nova_batalha->saveOrFail();
            $novo_desafio->saveOrFail();

            return true;
        });

        return $salvar;
    }

    public static function atacar($batalha, $dano) {
        $batalha->hp_oponente = $batalha->hp_oponente - $dano;
        $batalha->vez = 1;

        $salvar = DB::transaction(function () use ($batalha) {
            $batalha->saveOrFail();

            return true;
        });

        return $salvar;
    }

    public static function ataqueOponente($batalha, $dano) {
        $batalha->hp = $batalha->hp - $dano;
        $batalha->vez = 0;

        $salvar = DB::transaction(function () use ($batalha) {
            $batalha->saveOrFail();

            return true;
        });

        return $salvar;
    }

    public static function vitoria($player, $xp, $batalha) {
        if ($player->nivel < 70) {
            $player->xp = $player->xp + $xp;
            
            if ($player->xp >= 100) {
                $player->nivel++;
                $player->xp = 0;
            }
        }        

        $player->quantidade_vitorias = $player->quantidade_vitorias + 1;

        if (session("nome_oponente") == "Computador") {
            $batalha->perdeu = "Computador";
        } else {
            $batalha->perdeu = session("nome_oponente");
        }

        $batalha->ganhou = $player->usuario;
        $batalha->updated_at = date("Y-m-d H:i:s");

        $salvar = DB::transaction(function () use ($player, $batalha) {
            $player->saveOrFail();

            if (session()->has("id_player")) {

                $id_oponente = session("id_player");
                $oponente = Player::find($id_oponente);

                $oponente->quantidade_derrotas = $oponente->quantidade_derrotas + 1;
                $oponente->saveOrFail();
            }
            
            $batalha->saveOrFail();
            $batalha->delete();

            return true;
        });

        return $salvar;
    }

    public static function derrota($player, $batalha) {
        $player->quantidade_derrotas = $player->quantidade_derrotas + 1;

        if (session("nome_oponente") == "Computador") {
            $batalha->ganhou = "Computador";            
        } else {
            $batalha->ganhou = session("nome_oponente");
        }

        $batalha->perdeu = $player->usuario;
        $batalha->updated_at = date("Y-m-d H:i:s");

        $salvar = DB::transaction(function () use ($player, $batalha) {
            $player->saveOrFail();

            if (session()->has("id_player")) {

                $id = session("id_player");
                $player = Player::find($id);

                $player->quantidade_vitorias = $player->quantidade_vitorias + 1;
                $player->saveOrFail();
            }

            $batalha->saveOrFail();
            $batalha->delete();

            return true;
        });

        return $salvar;
    }

    public static function render($player, $batalha) {
        $player->quantidade_derrotas = $player->quantidade_derrotas + 1;

        if (session("nome_oponente") == "Computador") {
            $batalha->ganhou = "Computador";
        } else {
            $batalha->ganhou = session("nome_oponente");            
        }

        $batalha->perdeu = session("player.usuario");
        $batalha->updated_at = date("Y-m-d H:i:s");

        $salvar = DB::transaction(function () use ($player, $batalha) {
            $player->saveOrFail();

            if (session()->has("id_player")) {

                $id = session("id_player");
                $player = Player::find($id);

                $player->quantidade_vitorias = $player->quantidade_vitorias + 1;
                $player->saveOrFail();
            }

            $batalha->saveOrFail();
            $batalha->delete();

            return true;
        });

        return $salvar;
    }
} 