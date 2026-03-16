<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonagemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("personagems")->insert([
            [
                "classe" => "Guerreiro",
                "imagem" => "guerreiro.png",
                "descricao" => "O Guerreiro é a personificação da força e da honra. Treinado para o combate corpo a corpo, domina o uso de espadas, escudos e armaduras pesadas. Sua função é proteger seus aliados e manter a linha de frente em qualquer batalha. Fiel ao código da coragem e disciplina, o guerreiro enfrenta o perigo de frente, confiando tanto em sua lâmina quanto em sua determinação.",
                "tipo_dano" => "Físico",
                "alcance" => "Curta",
                "vida" => "Alta",
                "defesa" => "Alta",
                "hp" => 1600,
                "skill01_id" => 1,
                "skill02_id" => 2,
                "skill03_id" => 3
            ],

            [
                "classe" => "Mago",
                "imagem" => "mago.png",
                "descricao" => "O Mago é o mestre do conhecimento e do poder arcano. Munido de seu cajado e sabedoria ancestral, manipula as forças da natureza e do além para atacar, defender ou curar. Embora fisicamente frágil, sua mente é uma arma formidável, capaz de alterar o curso de uma guerra com um único feitiço. Sua presença inspira respeito e temor em igual medida.",
                "tipo_dano" => "Mágico",
                "alcance" => "Longa",
                "vida" => "Baixa",
                "defesa" => "Baixa",
                "hp" => 1100,
                "skill01_id" => 4,
                "skill02_id" => 5,
                "skill03_id" => 6
            ],

            [
                "classe" => "Assassino",
                "imagem" => "assassino.png",
                "descricao" => "O Assassino é o predador das sombras. Ágil, preciso e mortal, prefere o silêncio à força bruta. Treinado em técnicas furtivas e no uso de lâminas curtas, ele elimina seus alvos antes que possam reagir. Sua lealdade é incerta, sua presença quase imperceptível — e quando o inimigo o percebe, já é tarde demais.",
                "tipo_dano" => "Físico",
                "alcance" => "Curta",
                "vida" => "Média",
                "defesa" => "Média",
                "hp" => 1300,
                "skill01_id" => 7,
                "skill02_id" => 8,
                "skill03_id" => 9
            ]
        ]);
    }
}
