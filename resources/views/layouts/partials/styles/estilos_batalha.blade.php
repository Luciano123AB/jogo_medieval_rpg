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

    @media (height <= 900px) {
        #player,
        #magia_player,
        #efeito01_player,
        #efeito02_player,
        #efeito03_player,
        #oponente,
        #magia_oponente,
        #efeito01_oponente,
        #efeito02_oponente,
        #efeito03_oponente
        {
            width: 50%;            
        }
    }
</style>

@if (!$batalha->inicio)
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