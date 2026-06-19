<?php

namespace App\Services;

class Randoms
{
    public static function danoPlayerSorteado($batalha, $personagem, $nivel, $skill_escolhida) {

        $danos_skill01 = [$personagem->skill01->dano01, $personagem->skill01->dano02, $personagem->skill01->dano03];
        $danos_skill02 = [$personagem->skill02->dano01, $personagem->skill02->dano02, $personagem->skill02->dano03];
        $danos_skill03 = [$personagem->skill03->dano01, $personagem->skill03->dano02, $personagem->skill03->dano03];        
        $dano01_sorteado = $danos_skill01[array_rand($danos_skill01)];
        $dano02_sorteado = $danos_skill02[array_rand($danos_skill02)];
        $dano03_sorteado = $danos_skill03[array_rand($danos_skill03)];

        switch ($skill_escolhida) {
            case $personagem->skill01->skill:
                $batalha->skill01 = false;
                $batalha->save();

                return $dano01_sorteado * $nivel;
            break;

            case $personagem->skill02->skill:
                $batalha->skill02 = false;
                $batalha->save();

                return $dano02_sorteado * $nivel;
            break;

            case $personagem->skill03->skill:
                $batalha->skill03 = false;
                $batalha->save();

                return $dano03_sorteado * $nivel;
            break;
        }
    }

    public static function danoOponenteSorteado($batalha, $personagem, $nivel) {

        $skill01 = $personagem->skill01->skill;
        $skill02 = $personagem->skill02->skill;
        $skill03 = $personagem->skill03->skill;
        $danos_skill01 = [$personagem->skill01->dano01, $personagem->skill01->dano02, $personagem->skill01->dano03];
        $danos_skill02 = [$personagem->skill02->dano01, $personagem->skill02->dano02, $personagem->skill02->dano03];
        $danos_skill03 = [$personagem->skill03->dano01, $personagem->skill03->dano02, $personagem->skill03->dano03];
        $dano01_sorteado = $danos_skill01[array_rand($danos_skill01)];
        $dano02_sorteado = $danos_skill02[array_rand($danos_skill02)];
        $dano03_sorteado = $danos_skill03[array_rand($danos_skill03)];
        $skillsDisponiveis = [];

        if ($batalha->skill01_oponente == true) $skillsDisponiveis[] = $skill01;
        if ($batalha->skill02_oponente == true) $skillsDisponiveis[] = $skill02;
        if ($batalha->skill03_oponente == true) $skillsDisponiveis[] = $skill03;

        if (empty($skillsDisponiveis)) {
            $skillsDisponiveis = [$skill01, $skill02, $skill03];
        }

        switch ($skillsDisponiveis[array_rand($skillsDisponiveis)]) {
            case $skill01:
                $batalha->skill01_oponente = false;
                $batalha->save();

                return [
                    'dano' => $dano01_sorteado * $nivel,
                    'tipo_ataque' => 'normal'
                ];
            break;

            case $skill02:
                $batalha->skill02_oponente = false;
                $batalha->save();

                return [
                    'dano' => $dano02_sorteado * $nivel,
                    'tipo_ataque' => 'forte'
                ];
            break;

            case $skill03:
                $batalha->skill03_oponente = false;
                $batalha->save();

                return [
                    'dano' => $dano03_sorteado * $nivel,
                    'tipo_ataque' => 'ultimate'
                ];
            break;
        }
    }
}
