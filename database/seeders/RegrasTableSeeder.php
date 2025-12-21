<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegrasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("regras")->insert([
            [
                "regra" => "Vez",
                "explicacao" => "Quando a batalha começar, um sorteio decidi-rá quem vai atacar primeiro, e após o ataque ser efetuado a vez passará para o outro.",
                "icone" => "bi-dice-6-fill",
                "imagem" => "vez",
                "animacao01" => "animate__fadeInTopLeft",
                "animacao02" => "animate__rotateIn"
            ],

            [
                "regra" => "Tempo",
                "explicacao" => "Enquanto a batalha for se prolongando, um cronômetro no centro aumenta-rá constantemente até que a partida se encerre.",
                "icone" => "bi-alarm-fill",
                "imagem" => "tempo",
                "animacao01" => "animate__fadeInTopRight",
                "animacao02" => "animate__tada"
            ],

            [
                "regra" => "Barra de HP",
                "explicacao" => "Essa é a quantidade de vida de cada personagem, conforme a batalha for acontecendo, essas barras irão diminuindo a cada ataque do seu oponente.",
                "icone" => "bi-heart-fill",
                "imagem" => "barras_vida",
                "animacao01" => "animate__fadeInLeft",
                "animacao02" => "animate__heartBeat"
            ],

            [
                "regra" => "Skills/Ataques",
                "explicacao" => "Esses são os tipos de ofensivas que cada personagem possuí, cada uma deles podem ser utilizados apenas 1 vez a cada 3 rodadas.",
                "icone" => "bi-joystick",
                "imagem" => "skills",
                "animacao01" => "animate__fadeInRight",
                "animacao02" => "animate__headShake"
            ],

            [
                "regra" => "Contador de Dano",
                "explicacao" => "Esses números debaixo das barras de vida irão ser exibidos toda vez que você ou seu oponente desferir um ataque, a quantidade de dano de cada skill nem sempre será igual.",
                "icone" => "bi-crosshair2",
                "imagem" => "contador_danos",
                "animacao01" => "animate__fadeInBottomLeft",
                "animacao02" => "animate__bounceIn"
            ],

            [
                "regra" => "Se Render",
                "explicacao" => "Se o combate estiver se encaminhando para uma derrota certa ou você apenas queira desistir do duelo, haverá sempre um botão de <Render-se> no topo para usar, mas esteja ciente de que se usá-lo, também será somado 1 derrota.",
                "icone" => "bi-flag-fill",
                "imagem" => "render",
                "animacao01" => "animate__fadeInBottomRight",
                "animacao02" => "animate__wobble"
            ],

            [
                "regra" => "Vitória/Derrota",
                "explicacao" => "Caso a barra de vida do seu oponente cheque ao fim, você vence a batalha, mas caso a sua barra de vida acabe zerando primeiro, você perde.",
                "icone" => "bi-award-fill",
                "imagem" => "final",
                "animacao01" => "animate__fadeInBottomLeft",
                "animacao02" => "animate__swing"
            ]
        ]);
    }
}
