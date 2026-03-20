<?php

namespace App\Services;

class Randoms
{
    public static function danoPlayerSorteado($personagem, $nivel, $skill_escolhida) {

        $danos_skill01 = [$personagem->skill01->dano01, $personagem->skill01->dano02, $personagem->skill01->dano03];
        $danos_skill02 = [$personagem->skill02->dano01, $personagem->skill02->dano02, $personagem->skill02->dano03];
        $danos_skill03 = [$personagem->skill03->dano01, $personagem->skill03->dano02, $personagem->skill03->dano03];
        
        $dano01_sorteado = $danos_skill01[array_rand($danos_skill01)];
        $dano02_sorteado = $danos_skill02[array_rand($danos_skill02)];
        $dano03_sorteado = $danos_skill03[array_rand($danos_skill03)];

        if ($dano01_sorteado == $danos_skill01[2] || $dano02_sorteado == $danos_skill02[2] || $dano03_sorteado == $danos_skill03[2]) {
            session()->flash("dano_critico");
        }

        if ($personagem->tipo_dano === "Físico") {
            session()->flash("tipo_dano", "danger");
        } else {
            session()->flash("tipo_dano", "primary");
        }

        switch ($skill_escolhida) {
            case $personagem->skill01->skill:
                session(["skill01" => true]);
                session()->flash("normal_player");

                return $dano01_sorteado * $nivel;
            break;

            case $personagem->skill02->skill:
                session(["skill02" => true]);
                session()->flash("forte_player");

                return $dano02_sorteado * $nivel;
            break;

            case $personagem->skill03->skill:
                session(["skill03" => true]);
                session()->flash("ultimate_player");

                return $dano03_sorteado * $nivel;
            break;
        }
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

        $skillsDisponiveis = [];

        if (!session()->has("skill01_oponente")) $skillsDisponiveis[] = $skill01;
        if (!session()->has("skill02_oponente")) $skillsDisponiveis[] = $skill02;
        if (!session()->has("skill03_oponente")) $skillsDisponiveis[] = $skill03;

        if (empty($skillsDisponiveis)) {
            session()->forget(["skill01_oponente", "skill02_oponente", "skill03_oponente"]);

            $skillsDisponiveis = [$skill01, $skill02, $skill03];
        }

        if ($dano01_sorteado == $danos_skill01[2] || $dano02_sorteado == $danos_skill02[2] || $dano03_sorteado == $danos_skill03[2]) {
            session()->flash("dano_critico");
        }

        if ($personagem->tipo_dano === "Físico") {
            session()->flash("tipo_dano", "danger");
        } else {
            session()->flash("tipo_dano", "primary");
        }

        switch ($skillsDisponiveis[array_rand($skillsDisponiveis)]) {
            case $skill01:
                session(["skill01_oponente" => true]);
                session()->flash("normal_oponente");

                return $dano01_sorteado * $nivel;
            break;

            case $skill02:
                session(["skill02_oponente" => true]);
                session()->flash("forte_oponente");

                return $dano02_sorteado * $nivel;
            break;

            case $skill03:
                session(["skill03_oponente" => true]);
                session()->flash("ultimate_oponente");

                return $dano03_sorteado * $nivel;
            break;
        }
    }
}
