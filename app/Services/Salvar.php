<?php

namespace App\Services;

use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Salvar
{
    public static function cadastrar($novo_player) {
        $novo_player->user = session("dados.usuario");
        $novo_player->email = session("dados.email");
        $novo_player->password = Hash::make(session("dados.senha"));
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

        session()->forget("dados");

        return $salvar;
    }

    public static function atualizar($player) {
        $player->user = session("dados.usuario");
        $player->email = session("dados.email");
        $player->personagem_id = session("dados.classe");

        if (session("dados.foto") != "photos/vazio.png") {
            session()->flash("foto_antiga", $player->foto);
        }

        $player->foto = session("dados.foto");
        $player->updated_at = Carbon::now();

        $salvar = DB::transaction(function () use ($player) {
            $player->saveOrFail();

            return true;
        });

        session()->forget("dados");

        return $salvar;
    }

    public static function atualizarSenha($player) {
        
        $senha = session("nova_senha");

        $player->password = Hash::make($senha);

        $salvar = DB::transaction(function () use ($player) {
            $player->saveOrFail();

            return true;
        });

        session()->forget("nova_senha");

        return $salvar;
    }

    public static function batalharDesafiar($nova_batalha, $oponente, $nome_oponente, $nivel, $vez, $novo_desafio) {
        $nova_batalha->player_id = session("id_player") ?? null;
        $nova_batalha->oponente_id = session("id_oponente");
        $nova_batalha->nome = Auth::user()->user;
        $nova_batalha->nome_oponente = $nome_oponente;
        $nova_batalha->hp_maximo = Auth::user()->personagem->hp * Auth::user()->nivel;
        $nova_batalha->hp = Auth::user()->personagem->hp * Auth::user()->nivel;
        $nova_batalha->hp_maximo_oponente = $oponente->hp * $nivel;
        $nova_batalha->hp_oponente = $oponente->hp * $nivel;
        $nova_batalha->vez = $vez;
        $nova_batalha->ganhou = null;
        $nova_batalha->perdeu = null;
        $nova_batalha->created_at = date("Y-m-d H:i:s");

        $novo_desafio->desafiador_id = Auth::user()->id;
        $novo_desafio->desafiado_id = session("id_player");

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
            
            if ($player->xp >= 1000) {
                $player->nivel++;
                $player->xp = $player->xp - 1000;
            }
        }

        $player->quantidade_vitorias = $player->quantidade_vitorias + 1;

        if ($batalha->nome_oponente == "Computador") {
            $batalha->perdeu = "Computador";
        } else {
            $batalha->perdeu = $batalha->nome_oponente;
        }

        $batalha->ganhou = $player->user;
        $batalha->updated_at = Carbon::now();

        $salvar = DB::transaction(function () use ($player, $batalha) {
            $player->saveOrFail();

            if ($batalha->player_id != null) {

                $id_oponente = $batalha->player_id;
                $oponente = Player::findOrFail($id_oponente);

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

        if ($batalha->nome_oponente == "Computador") {
            $batalha->ganhou = "Computador";            
        } else {
            $batalha->ganhou = $batalha->nome_oponente;
        }

        $batalha->perdeu = $player->user;
        $batalha->updated_at = Carbon::now();

        $salvar = DB::transaction(function () use ($player, $batalha) {
            $player->saveOrFail();

            if ($batalha->player_id != null) {

                $id = $batalha->player_id;
                $player = Player::findOrFail($id);

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

        if ($batalha->nome_oponente == "Computador") {
            $batalha->ganhou = "Computador";
        } else {
            $batalha->ganhou = $batalha->nome_oponente;            
        }

        $batalha->perdeu = Auth::user()->user;
        $batalha->updated_at = Carbon::now();

        $salvar = DB::transaction(function () use ($player, $batalha) {
            $player->saveOrFail();

            if ($batalha->player_id != null) {

                $id = $batalha->player_id;
                $player = Player::findOrFail($id);

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