<?php

namespace App\Services;

class Randoms
{
    public static function danoPlayerSorteado($personagem, $nivel, $skill_escolhida) {

        $skill01 = $personagem->skill01->skill;
        $skill02 = $personagem->skill02->skill;
        $skill03 = $personagem->skill03->skill;

        $danos_skill01 = [$personagem->skill01->dano01, $personagem->skill01->dano02, $personagem->skill01->dano03];
        $danos_skill02 = [$personagem->skill02->dano01, $personagem->skill02->dano02, $personagem->skill02->dano03];
        $danos_skill03 = [$personagem->skill03->dano01, $personagem->skill03->dano02, $personagem->skill03->dano03];
        
        $dano01_sorteado = $danos_skill01[array_rand($danos_skill01)];
        $dano02_sorteado = $danos_skill02[array_rand($danos_skill02)];
        $dano03_sorteado = $danos_skill03[array_rand($danos_skill03)];

        switch ($skill_escolhida) {
            case "$skill01":
                $dano = $dano01_sorteado * $nivel;

                if ($dano01_sorteado == $danos_skill01[2]) {
                    session()->flash("dano_critico");
                }

                session(["skill01" => true]);
            break;

            case "$skill02":
                $dano = $dano02_sorteado * $nivel;

                if ($dano02_sorteado == $danos_skill02[2]) {
                    session()->flash("dano_critico");
                }

                session(["skill02" => true]);
                session()->flash("forte_player");
            break;

            case "$skill03":
                $dano = $dano03_sorteado * $nivel;

                if ($dano03_sorteado == $danos_skill03[2]) {
                    session()->flash("dano_critico");
                }

                session(["skill03" => true]);
                session()->flash("ultimate_player");
            break;
        }

        return $dano;
    }

    public static function danoOponenteSorteado($personagem, $nivel) {

        $skill01 = $personagem->skill01->skill;
        $skill02 = $personagem->skill02->skill;
        $skill03 = $personagem->skill03->skill;

        $danos_skill01 = [$personagem->skill01->dano01, $personagem->skill01->dano02, $personagem->skill01->dano03];
        $danos_skill02 = [$personagem->skill02->dano01, $personagem->skill02->dano02, $personagem->skill02->dano03];
        $danos_skill03 = [$personagem->skill03->dano01, $personagem->skill03->dano02, $personagem->skill03->dano03];

        $dano01_sorteado = $danos_skill01[array_rand($danos_skill01)];
        $dano02_sorteado = $danos_skill02[array_rand($danos_skill02)];
        $dano03_sorteado = $danos_skill03[array_rand($danos_skill03)];

        $todasSkills = [$skill01, $skill02, $skill03];
        $skillsDisponiveis = [];

        if (!session()->has("skill01_oponente")) $skillsDisponiveis[] = $skill01;
        if (!session()->has("skill02_oponente")) $skillsDisponiveis[] = $skill02;
        if (!session()->has("skill03_oponente")) $skillsDisponiveis[] = $skill03;

        if (empty($skillsDisponiveis)) {
            session()->forget(["skill01_oponente", "skill02_oponente", "skill03_oponente"]);

            $skillsDisponiveis = $todasSkills;
        }

        $skill_sorteado = $skillsDisponiveis[array_rand($skillsDisponiveis)];

        switch ($skill_sorteado) {
            case $skill01:
                $dano = $dano01_sorteado * $nivel;

                if ($dano01_sorteado == $danos_skill01[2]) {
                    session()->flash("dano_critico");
                }

                session(["skill01_oponente" => true]);
            break;

            case $skill02:
                $dano = $dano02_sorteado * $nivel;

                if ($dano02_sorteado == $danos_skill02[2]) {
                    session()->flash("dano_critico");
                }

                session(["skill02_oponente" => true]);
                session()->flash("forte_oponente");
            break;

            case $skill03:
                $dano = $dano03_sorteado * $nivel;

                if ($dano03_sorteado == $danos_skill03[2]) {
                    session()->flash("dano_critico");
                }

                session(["skill03_oponente" => true]);
                session()->flash("ultimate_oponente");
            break;
        }

        return $dano;
    }
}
