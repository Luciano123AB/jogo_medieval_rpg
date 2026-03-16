<div class="cards sombras card bg-{{ $temas[0] }} border-start border-{{ $temas[1] }} rounded">
    <div class="card-header text-center border-bottom border-{{ $temas[1] }}">
        <h4 class="cor_fontes_{{ $temas[2] }} card-title">
            @if($personagem->classe == "Guerreiro")
                🛡️
            @elseif($personagem->classe == "Mago")
                🔮
            @else
                🗡️
            @endif
            <span class="titulos_{{ $temas[2] }}">{{ $personagem->classe }}</span>
        </h4>
    </div>

    <img src="{{ asset('assets/images/personagens/' . strtolower($personagem->classe) . '.png') }}" id="personagem_{{ $personagem->id }}" class="card-img-top border-bottom border-{{ $temas[1] }}">
    
    <div class="card-body">
        <h5 class="cor_fontes_{{ $temas[2] }} card-title text-center fw-bold">
            <i class="bi bi-file-text-fill"></i>
            Sobre:
        </h5>
        <p class="cor_fontes_{{ $temas[2] }} card-text text-center">{{ $personagem->descricao }}</p>
    </div>

    <div class="card-body border-top border-{{ $temas[1] }}">
        <h5 class="cor_fontes_{{ $temas[2] }} card-title fw-bold">Atributos:</h5>
        <ul class="list-group list-group-flush">
            <li class="cor_fontes_{{ $temas[2] }} bg-{{ $temas[0] }} list-group-item">🎯 Tipo de dano: {{ $personagem->tipo_dano }}</li>
            <li class="cor_fontes_{{ $temas[2] }} bg-{{ $temas[0] }} list-group-item">➡️ Alcance: {{ $personagem->alcance }} distância</li>
            <li class="cor_fontes_{{ $temas[2] }} bg-{{ $temas[0] }} list-group-item">❤️ Vida: {{ $personagem->vida }}</li>
            <li class="cor_fontes_{{ $temas[2] }} bg-{{ $temas[0] }} list-group-item">🔰 Defesa: {{ $personagem->defesa }}</li>
        </ul>
    </div>

    <div class="card-body border-top border-{{ $temas[1] }}">
        <h5 class="cor_fontes_{{ $temas[2] }} card-title fw-bold">🕹 Skills:</h5>
        <ul class="list-group list-group-flush">
            <li class="cor_fontes_{{ $temas[2] }} bg-{{ $temas[0] }} list-group-item">1 - {{ $personagem->skill01?->skill }}</li>
            <li class="cor_fontes_{{ $temas[2] }} bg-{{ $temas[0] }} list-group-item">2 - {{ $personagem->skill02?->skill }}</li>
            <li class="cor_fontes_{{ $temas[2] }} bg-{{ $temas[0] }} list-group-item">3 - {{ $personagem->skill03?->skill }}</li>
        </ul>
    </div>
</div>

<script>

    const imagem_{{ $personagem->id }} = document.getElementById("personagem_{{ $personagem->id }}");

    setInterval(() => {
        if (imagem_{{ $personagem->id }}.src === "{{ asset('assets/images/personagens/' . strtolower($personagem->classe) . '.png') }}") {
            imagem_{{ $personagem->id }}.src = "{{ asset('assets/images/personagens_ataque/' . strtolower($personagem->classe) . '.png') }}";
        } else {
            imagem_{{ $personagem->id }}.src = "{{ asset('assets/images/personagens/' . strtolower($personagem->classe) . '.png') }}";
        }
    }, 1000);
</script>