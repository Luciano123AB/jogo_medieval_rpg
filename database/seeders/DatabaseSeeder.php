<?php

namespace Database\Seeders;

use App\Models\Player;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('regras')->insert([
            [
                'regra' => 'Vez',
                'explicacao' => 'Quando a batalha começar, um sorteio decidi-rá quem vai atacar primeiro, e após o ataque ser efetuado a vez passará para o outro.',
                'icone' => 'bi-dice-6-fill',
                'imagem' => 'vez',
                'animacao01' => 'animate__fadeInTopLeft',
                'animacao02' => 'animate__rotateIn'
            ],

            [
                'regra' => 'Tempo',
                'explicacao' => 'Enquanto a batalha for se prolongando, um cronômetro no centro aumenta-rá constantemente até que a partida se encerre.',
                'icone' => 'bi-alarm-fill',
                'imagem' => 'tempo',
                'animacao01' => 'animate__fadeInTopRight',
                'animacao02' => 'animate__tada'
            ],

            [
                'regra' => 'Barra de HP',
                'explicacao' => 'Essa é a quantidade de vida de cada personagem, conforme a batalha for acontecendo, essas barras irão diminuindo a cada ataque do seu oponente.',
                'icone' => 'bi-heart-fill',
                'imagem' => 'barras_vida',
                'animacao01' => 'animate__fadeInLeft',
                'animacao02' => 'animate__heartBeat'
            ],

            [
                'regra' => 'Skills/Ataques',
                'explicacao' => 'Esses são os tipos de ofensivas que cada personagem possuí, cada uma deles podem ser utilizados apenas 1 vez a cada 3 rodadas.',
                'icone' => 'bi-joystick',
                'imagem' => 'skills',
                'animacao01' => 'animate__fadeInRight',
                'animacao02' => 'animate__headShake'
            ],

            [
                'regra' => 'Contador de Dano',
                'explicacao' => 'Esses números debaixo das barras de vida irão ser exibidos toda vez que você ou seu oponente desferir um ataque, a quantidade de dano de cada skill nem sempre será igual.',
                'icone' => 'bi-crosshair2',
                'imagem' => 'contador_danos',
                'animacao01' => 'animate__fadeInBottomLeft',
                'animacao02' => 'animate__bounceIn'
            ],

            [
                'regra' => 'Se Render',
                'explicacao' => 'Se o combate estiver se encaminhando para uma derrota certa ou você apenas queira desistir do duelo, haverá sempre um botão de <Render-se> no topo para usar, mas esteja ciente de que se usá-lo, também será somado 1 derrota.',
                'icone' => 'bi-flag-fill',
                'imagem' => 'render',
                'animacao01' => 'animate__fadeInBottomRight',
                'animacao02' => 'animate__wobble'
            ],

            [
                'regra' => 'Vitória/Derrota',
                'explicacao' => 'Caso a barra de vida do seu oponente cheque ao fim, você vence a batalha, mas caso a sua barra de vida acabe zerando primeiro, você perde.',
                'icone' => 'bi-award-fill',
                'imagem' => 'final',
                'animacao01' => 'animate__fadeInBottomLeft',
                'animacao02' => 'animate__swing'
            ]
        ]);

        DB::table('skills')->insert([
            [
                'skill' => 'Golpe do Juramento',
                'dano01' => 65,
                'dano02' => 90,
                'dano03' => 120
            ],

            [
                'skill' => 'Rasgo do Aço',
                'dano01' => 50,
                'dano02' => 75,
                'dano03' => 100
            ],

            [
                'skill' => 'Martelo de Guerra',
                'dano01' => 80,
                'dano02' => 110,
                'dano03' => 150
            ],

            [
                'skill' => 'Explosão Arcana',
                'dano01' => 80,
                'dano02' => 130,
                'dano03' => 180
            ],

            [
                'skill' => 'Chama Etérea',
                'dano01' => 70,
                'dano02' => 100,
                'dano03' => 140
            ],

            [
                'skill' => 'Raio do Vazio',
                'dano01' => 100,
                'dano02' => 160,
                'dano03' => 220
            ],

            [
                'skill' => 'Golpe Sombrio',
                'dano01' => 60,
                'dano02' => 85,
                'dano03' => 115
            ],

            [
                'skill' => 'Dança das Lâminas',
                'dano01' => 45,
                'dano02' => 80,
                'dano03' => 105
            ],

            [
                'skill' => 'Perfuração Silenciosa',
                'dano01' => 90,
                'dano02' => 120,
                'dano03' => 160
            ]
        ]);

        DB::table('personagems')->insert([
            [
                'classe' => 'Guerreiro',
                'imagem' => 'guerreiro.png',
                'descricao' => 'O Guerreiro é a personificação da força e da honra. Treinado para o combate corpo a corpo, domina o uso de espadas, escudos e armaduras pesadas. Sua função é proteger seus aliados e manter a linha de frente em qualquer batalha. Fiel ao código da coragem e disciplina, o guerreiro enfrenta o perigo de frente, confiando tanto em sua lâmina quanto em sua determinação.',
                'tipo_dano' => 'Físico',
                'alcance' => 'Curta',
                'vida' => 'Alta',
                'defesa' => 'Alta',
                'hp' => 1600,
                'skill01_id' => 1,
                'skill02_id' => 2,
                'skill03_id' => 3
            ],

            [
                'classe' => 'Mago',
                'imagem' => 'mago.png',
                'descricao' => 'O Mago é o mestre do conhecimento e do poder arcano. Munido de seu cajado e sabedoria ancestral, manipula as forças da natureza e do além para atacar, defender ou curar. Embora fisicamente frágil, sua mente é uma arma formidável, capaz de alterar o curso de uma guerra com um único feitiço. Sua presença inspira respeito e temor em igual medida.',
                'tipo_dano' => 'Mágico',
                'alcance' => 'Longa',
                'vida' => 'Baixa',
                'defesa' => 'Baixa',
                'hp' => 1100,
                'skill01_id' => 4,
                'skill02_id' => 5,
                'skill03_id' => 6
            ],

            [
                'classe' => 'Assassino',
                'imagem' => 'assassino.png',
                'descricao' => 'O Assassino é o predador das sombras. Ágil, preciso e mortal, prefere o silêncio à força bruta. Treinado em técnicas furtivas e no uso de lâminas curtas, ele elimina seus alvos antes que possam reagir. Sua lealdade é incerta, sua presença quase imperceptível — e quando o inimigo o percebe, já é tarde demais.',
                'tipo_dano' => 'Físico',
                'alcance' => 'Curta',
                'vida' => 'Média',
                'defesa' => 'Média',
                'hp' => 1300,
                'skill01_id' => 7,
                'skill02_id' => 8,
                'skill03_id' => 9
            ]
        ]);
    }
}
