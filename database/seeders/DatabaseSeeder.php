<?php

namespace Database\Seeders;

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

        DB::table("skills")->insert([
            [
                "skill" => "Golpe do Juramento",
                "dano01" => 65,
                "dano02" => 90,
                "dano03" => 120
            ],

            [
                "skill" => "Rasgo do Aço",
                "dano01" => 50,
                "dano02" => 75,
                "dano03" => 100
            ],

            [
                "skill" => "Martelo de Guerra",
                "dano01" => 80,
                "dano02" => 110,
                "dano03" => 150
            ],

            [
                "skill" => "Explosão Arcana",
                "dano01" => 80,
                "dano02" => 130,
                "dano03" => 180
            ],

            [
                "skill" => "Chama Etérea",
                "dano01" => 70,
                "dano02" => 100,
                "dano03" => 140
            ],

            [
                "skill" => "Raio do Vazio",
                "dano01" => 100,
                "dano02" => 160,
                "dano03" => 220
            ],

            [
                "skill" => "Golpe Sombrio",
                "dano01" => 60,
                "dano02" => 85,
                "dano03" => 115
            ],

            [
                "skill" => "Dança das Lâminas",
                "dano01" => 45,
                "dano02" => 80,
                "dano03" => 105
            ],

            [
                "skill" => "Perfuração Silenciosa",
                "dano01" => 90,
                "dano02" => 120,
                "dano03" => 160
            ]
        ]);

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

        DB::table("players")->insert([
            ["user"=>"Luciano123AB","email"=>"luciano@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"BR","foto"=>"photos/vazio.png","nivel"=>70,"xp"=>0,"quantidade_vitorias"=>300,"quantidade_derrotas"=>45,"personagem_id"=>2,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Joao123AB","email"=>"joao@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"PT","foto"=>"photos/vazio.png","nivel"=>5,"xp"=>750,"quantidade_vitorias"=>3,"quantidade_derrotas"=>1,"personagem_id"=>1,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Maria123AB","email"=>"maria@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"ES","foto"=>"photos/vazio.png","nivel"=>8,"xp"=>400,"quantidade_vitorias"=>6,"quantidade_derrotas"=>4,"personagem_id"=>2,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Pedro123AB","email"=>"pedro@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"AR","foto"=>"photos/vazio.png","nivel"=>12,"xp"=>900,"quantidade_vitorias"=>15,"quantidade_derrotas"=>2,"personagem_id"=>3,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Ana123AB","email"=>"ana@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"US","foto"=>"photos/vazio.png","nivel"=>20,"xp"=>550,"quantidade_vitorias"=>22,"quantidade_derrotas"=>10,"personagem_id"=>1,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Lucas123AB","email"=>"lucas@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"MX","foto"=>"photos/vazio.png","nivel"=>18,"xp"=>100,"quantidade_vitorias"=>19,"quantidade_derrotas"=>8,"personagem_id"=>2,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Julia123AB","email"=>"julia@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"IT","foto"=>"photos/vazio.png","nivel"=>25,"xp"=>990,"quantidade_vitorias"=>40,"quantidade_derrotas"=>11,"personagem_id"=>3,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Gabriel123AB","email"=>"gabriel@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"DE","foto"=>"photos/vazio.png","nivel"=>30,"xp"=>220,"quantidade_vitorias"=>50,"quantidade_derrotas"=>17,"personagem_id"=>1,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Beatriz123AB","email"=>"beatriz@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"FR","foto"=>"photos/vazio.png","nivel"=>14,"xp"=>600,"quantidade_vitorias"=>17,"quantidade_derrotas"=>6,"personagem_id"=>2,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Rafael123AB","email"=>"rafael@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"JP","foto"=>"photos/vazio.png","nivel"=>33,"xp"=>450,"quantidade_vitorias"=>60,"quantidade_derrotas"=>20,"personagem_id"=>3,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Carla123AB","email"=>"carla@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"CA","foto"=>"photos/vazio.png","nivel"=>10,"xp"=>150,"quantidade_vitorias"=>9,"quantidade_derrotas"=>5,"personagem_id"=>1,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Matheus123AB","email"=>"matheus@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"RU","foto"=>"photos/vazio.png","nivel"=>40,"xp"=>700,"quantidade_vitorias"=>88,"quantidade_derrotas"=>30,"personagem_id"=>2,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Larissa123AB","email"=>"larissa@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"CN","foto"=>"photos/vazio.png","nivel"=>22,"xp"=>800,"quantidade_vitorias"=>34,"quantidade_derrotas"=>14,"personagem_id"=>3,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Vinicius123AB","email"=>"vinicius@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"KR","foto"=>"photos/vazio.png","nivel"=>27,"xp"=>350,"quantidade_vitorias"=>41,"quantidade_derrotas"=>16,"personagem_id"=>1,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Renata123AB","email"=>"renata@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"SE","foto"=>"photos/vazio.png","nivel"=>19,"xp"=>440,"quantidade_vitorias"=>21,"quantidade_derrotas"=>9,"personagem_id"=>2,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Bruno123AB","email"=>"bruno@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"NO","foto"=>"photos/vazio.png","nivel"=>55,"xp"=>100,"quantidade_vitorias"=>120,"quantidade_derrotas"=>40,"personagem_id"=>3,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Camila123AB","email"=>"camila@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"CH","foto"=>"photos/vazio.png","nivel"=>35,"xp"=>650,"quantidade_vitorias"=>68,"quantidade_derrotas"=>20,"personagem_id"=>1,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Diego123AB","email"=>"diego@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"ZA","foto"=>"photos/vazio.png","nivel"=>48,"xp"=>500,"quantidade_vitorias"=>95,"quantidade_derrotas"=>33,"personagem_id"=>2,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Paula123AB","email"=>"paula@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"EG","foto"=>"photos/vazio.png","nivel"=>16,"xp"=>200,"quantidade_vitorias"=>15,"quantidade_derrotas"=>10,"personagem_id"=>3,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Andre123AB","email"=>"andre@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"IN","foto"=>"photos/vazio.png","nivel"=>60,"xp"=>950,"quantidade_vitorias"=>150,"quantidade_derrotas"=>50,"personagem_id"=>1,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Leticia123AB","email"=>"leticia@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"AU","foto"=>"photos/vazio.png","nivel"=>28,"xp"=>780,"quantidade_vitorias"=>55,"quantidade_derrotas"=>21,"personagem_id"=>2,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Thiago123AB","email"=>"thiago@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"NZ","foto"=>"photos/vazio.png","nivel"=>70,"xp"=>0,"quantidade_vitorias"=>250,"quantidade_derrotas"=>90,"personagem_id"=>3,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Aline123AB","email"=>"aline@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"CL","foto"=>"photos/vazio.png","nivel"=>24,"xp"=>580,"quantidade_vitorias"=>44,"quantidade_derrotas"=>19,"personagem_id"=>1,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Felipe123AB","email"=>"felipe@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"PL","foto"=>"photos/vazio.png","nivel"=>45,"xp"=>320,"quantidade_vitorias"=>90,"quantidade_derrotas"=>30,"personagem_id"=>2,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Sofia123AB","email"=>"sofia@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"UA","foto"=>"photos/vazio.png","nivel"=>13,"xp"=>250,"quantidade_vitorias"=>12,"quantidade_derrotas"=>7,"personagem_id"=>3,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Igor123AB","email"=>"igor@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"RO","foto"=>"photos/vazio.png","nivel"=>38,"xp"=>660,"quantidade_vitorias"=>72,"quantidade_derrotas"=>24,"personagem_id"=>1,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Carol123AB","email"=>"carol@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Outro","pais"=>"IE","foto"=>"photos/vazio.png","nivel"=>21,"xp"=>470,"quantidade_vitorias"=>30,"quantidade_derrotas"=>15,"personagem_id"=>2,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Samuel123AB","email"=>"samuel@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"FI","foto"=>"photos/vazio.png","nivel"=>52,"xp"=>820,"quantidade_vitorias"=>110,"quantidade_derrotas"=>44,"personagem_id"=>3,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Natalia123AB","email"=>"natalia@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"DK","foto"=>"photos/vazio.png","nivel"=>18,"xp"=>360,"quantidade_vitorias"=>19,"quantidade_derrotas"=>11,"personagem_id"=>1,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Eduardo123AB","email"=>"eduardo@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"NL","foto"=>"photos/vazio.png","nivel"=>65,"xp"=>120,"quantidade_vitorias"=>170,"quantidade_derrotas"=>60,"personagem_id"=>2,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Patricia123AB","email"=>"patricia@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"BE","foto"=>"photos/vazio.png","nivel"=>29,"xp"=>930,"quantidade_vitorias"=>58,"quantidade_derrotas"=>23,"personagem_id"=>3,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Leonardo123AB","email"=>"leonardo@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"AT","foto"=>"photos/vazio.png","nivel"=>42,"xp"=>610,"quantidade_vitorias"=>85,"quantidade_derrotas"=>29,"personagem_id"=>1,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Monica123AB","email"=>"monica@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"GR","foto"=>"photos/vazio.png","nivel"=>34,"xp"=>780,"quantidade_vitorias"=>70,"quantidade_derrotas"=>26,"personagem_id"=>2,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Daniel123AB","email"=>"daniel@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"TR","foto"=>"photos/vazio.png","nivel"=>50,"xp"=>400,"quantidade_vitorias"=>100,"quantidade_derrotas"=>40,"personagem_id"=>3,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Vanessa123AB","email"=>"vanessa@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"IL","foto"=>"photos/vazio.png","nivel"=>26,"xp"=>690,"quantidade_vitorias"=>49,"quantidade_derrotas"=>18,"personagem_id"=>1,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Marcos123AB","email"=>"marcos@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"AE","foto"=>"photos/vazio.png","nivel"=>58,"xp"=>880,"quantidade_vitorias"=>130,"quantidade_derrotas"=>55,"personagem_id"=>2,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Ricardo123AB","email"=>"ricardo@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"SA","foto"=>"photos/vazio.png","nivel"=>31,"xp"=>540,"quantidade_vitorias"=>62,"quantidade_derrotas"=>21,"personagem_id"=>1,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Fernanda123AB","email"=>"fernanda@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"IR","foto"=>"photos/vazio.png","nivel"=>23,"xp"=>480,"quantidade_vitorias"=>39,"quantidade_derrotas"=>17,"personagem_id"=>2,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Gustavo123AB","email"=>"gustavo@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"TH","foto"=>"photos/vazio.png","nivel"=>46,"xp"=>710,"quantidade_vitorias"=>92,"quantidade_derrotas"=>28,"personagem_id"=>3,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Priscila123AB","email"=>"priscila@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"PH","foto"=>"photos/vazio.png","nivel"=>17,"xp"=>290,"quantidade_vitorias"=>18,"quantidade_derrotas"=>9,"personagem_id"=>1,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Hugo123AB","email"=>"hugo@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"VN","foto"=>"photos/vazio.png","nivel"=>39,"xp"=>830,"quantidade_vitorias"=>79,"quantidade_derrotas"=>26,"personagem_id"=>2,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Bianca123AB","email"=>"bianca@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"ID","foto"=>"photos/vazio.png","nivel"=>27,"xp"=>660,"quantidade_vitorias"=>51,"quantidade_derrotas"=>20,"personagem_id"=>3,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Caio123AB","email"=>"caio@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"MY","foto"=>"photos/vazio.png","nivel"=>44,"xp"=>150,"quantidade_vitorias"=>87,"quantidade_derrotas"=>35,"personagem_id"=>1,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Daniela123AB","email"=>"daniela@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"SG","foto"=>"photos/vazio.png","nivel"=>21,"xp"=>500,"quantidade_vitorias"=>33,"quantidade_derrotas"=>14,"personagem_id"=>2,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Rodrigo123AB","email"=>"rodrigo@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"QA","foto"=>"photos/vazio.png","nivel"=>59,"xp"=>920,"quantidade_vitorias"=>140,"quantidade_derrotas"=>57,"personagem_id"=>3,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Tais123AB","email"=>"tais@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"KW","foto"=>"photos/vazio.png","nivel"=>15,"xp"=>180,"quantidade_vitorias"=>14,"quantidade_derrotas"=>8,"personagem_id"=>1,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Alex123AB","email"=>"alex@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Outro","pais"=>"OM","foto"=>"photos/vazio.png","nivel"=>36,"xp"=>74.0,"quantidade_vitorias"=>69,"quantidade_derrotas"=>31,"personagem_id"=>2,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Isabela123AB","email"=>"isabela@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"MA","foto"=>"photos/vazio.png","nivel"=>32,"xp"=>610,"quantidade_vitorias"=>64,"quantidade_derrotas"=>25,"personagem_id"=>3,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Otavio123AB","email"=>"otavio@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Masculino","pais"=>"TN","foto"=>"photos/vazio.png","nivel"=>41,"xp"=>890,"quantidade_vitorias"=>81,"quantidade_derrotas"=>29,"personagem_id"=>1,"created_at"=>date("Y-m-d H:i:s")],
            ["user"=>"Yasmin123AB","email"=>"yasmin@gmail.com","password"=>Hash::make("24032004ABcd123"),"genero"=>"Feminino","pais"=>"NG","foto"=>"photos/vazio.png","nivel"=>19,"xp"=>340,"quantidade_vitorias"=>22,"quantidade_derrotas"=>11,"personagem_id"=>2,"created_at"=>date("Y-m-d H:i:s")]
        ]);
    }
}
