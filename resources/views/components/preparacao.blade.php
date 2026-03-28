<div class="cards sombras card bg-{{ $temas[0] }} border-{{ $temas[1] }}">
    <div class="card-header text-center border-bottom border-{{ $temas[1] }}">
        <h4 class="cor_fontes_{{ $temas[4] }} card-title">
            @if($personagem->classe == "Guerreiro")
                🛡️
            @elseif($personagem->classe == "Mago")
                🔮
            @else
                🗡️
            @endif
            <span class="titulos_{{ $temas[4] }}">{{ $personagem->classe }}</span>
        </h4>
        <label class="{{ $temas[2] }}">Nível: {{ $nivel }}{{ $nivel == 70 ? " Max" : "" }}</label>
    </div>

    <img src="{{ asset("assets/images/personagens/" . strtolower($personagem->classe) . "_reverso.png") }}" class="card-img-top border-bottom border-{{ $temas[1] }}">

    <div class="form-check d-flex justify-content-center">
        <input class="form-check-input cursor focus-ring border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} my-2 me-1" type="radio" name="oponente" value="{{ $personagem->id }}" id="oponente{{ $personagem->id }}">
        <label class="form-check-label pt-1" for="oponente{{ $personagem->id }}">
            <span class="cursor cor_fontes_{{ $temas[4] }}">SELECIONAR</span>
        </label>
    </div>
</div>