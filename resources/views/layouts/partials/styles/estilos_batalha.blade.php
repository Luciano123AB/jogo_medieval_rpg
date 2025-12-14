@php

    $classe_player = session("player.personagem.classe");
    $classe_oponente = $oponente->classe;

    $aura_player = match ($classe_player) {
        "Guerreiro" => "guerreiro",
        "Mago" => "mago",
        default => "assassino",
    };

    $aura_oponente = match ($classe_oponente) {
        "Guerreiro" => "guerreiro",
        "Mago" => "mago",
        default => "assassino",
    };
@endphp

@if(!session()->has("alerta_confirmar_render") && !session()->has("alerta_resultado"))
    <style>
        #player {
            position: relative;
            z-index: 9999;
        }
    </style>
@endif

<style>
    #player {
        background-image: url('{{ asset("assets/images/gifs/auras/$aura_player.gif") }}');
        background-size: 150% 110%;
        background-repeat: no-repeat;
        background-position: center;
    }

    #oponente {
        background-image: url('{{ asset("assets/images/gifs/auras/$aura_oponente.gif") }}');
        background-size: 150% 110%;
        background-repeat: no-repeat;
        background-position: center;
    }
</style>
