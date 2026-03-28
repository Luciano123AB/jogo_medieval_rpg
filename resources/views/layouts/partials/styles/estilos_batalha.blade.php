@php

    $classe_player = Auth::user()->personagem->classe;
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

<style>
    .cards_batalha {
        width: 15%;
        min-width: 280px;
    }

    #player {
        background-size: 150% 110%;
        background-repeat: no-repeat;
        background-position: center;
    }

    #oponente {
        background-size: 150% 110%;
        background-repeat: no-repeat;
        background-position: center;
    }
</style>

@if (
    $batalha->skill01 &&
    $batalha->skill02 &&
    $batalha->skill03 &&
    $batalha->skill01_oponente &&
    $batalha->skill02_oponente &&
    $batalha->skill03_oponente
)
    
@else
    @if ($vez == 1)
        <style>
            #player {
                background-image: url('{{ asset("assets/images/gifs/auras/$aura_player.gif") }}');
            }
        </style>
    @else
        <style>
            #oponente {
                background-image: url('{{ asset("assets/images/gifs/auras/$aura_oponente.gif") }}');
            }
        </style>
    @endif
@endif