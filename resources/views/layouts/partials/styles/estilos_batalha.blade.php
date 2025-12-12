@if(session("player.personagem.classe") == "Guerreiro")
    <style>
        #player {
            background-image: url('{{ asset('assets/images/gifs/auras/guerreiro.gif') }}');
            background-size: 108% 108%;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
@elseif(session("player.personagem.classe") == "Mago")
    <style>
        #player {
            background-image: url('{{ asset('assets/images/gifs/auras/mago.gif') }}');
            background-size: 108% 108%;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
@else
    <style>
        #player {
            background-image: url('{{ asset('assets/images/gifs/auras/aura_assassino.gif') }}');
            background-size: 108% 108%;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
@endif

@if($oponente->classe == "Guerreiro")
    <style>
        #oponente {
            background-image: url('{{ asset('assets/images/gifs/auras/guerreiro.gif') }}');
            background-size: 108% 108%;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
@elseif($oponente->classe == "Mago")
    <style>
        #oponente {
            background-image: url('{{ asset('assets/images/gifs/auras/mago.gif') }}');
            background-size: 108% 108%;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
@else
    <style>
        #oponente {
            background-image: url('{{ asset('assets/images/gifs/auras/assassino.gif') }}');
            background-size: 108% 108%;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
@endif