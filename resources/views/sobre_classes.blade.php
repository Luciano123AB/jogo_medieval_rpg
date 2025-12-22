@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="fundos_card_{{ session("tema") }} card p-3">
            <div class="animate__animated animate__fadeInLeft card-group gap-3 w-100">
                @foreach ($personagens as $personagem)
                    <div class="cards sombras card {{ session("tema") == "escuro" ? "bg-secondary border-start border-primary" : "bg-dark border-start border-danger" }} rounded">
                        <div class="card-header text-center border-bottom {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }}">
                            <h4 class="cor_fontes_{{ session("tema") }} card-title">
                                @if($personagem->classe == "Guerreiro")
                                    🛡️
                                @elseif($personagem->classe == "Mago")
                                    🔮
                                @else
                                    🗡️
                                @endif
                                <span class="titulos_{{ session("tema") }}">{{ $personagem->classe }}</span>
                            </h4>
                        </div>

                        <img src="{{ asset("assets/images/personagens/$personagem->imagem") }}" class="card-img-top border-bottom {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }}">
                        
                        <div class="card-body">
                            <h5 class="cor_fontes_{{ session("tema") }} card-title text-center fw-bold">
                                <i class="bi bi-file-text-fill"></i>
                                Sobre:
                            </h5>
                            <p class="cor_fontes_{{ session("tema") }} card-text text-center">{{ $personagem->descricao }}</p>                            
                        </div>

                        <div class="card-body border-top {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }}">
                            <h5 class="cor_fontes_{{ session("tema") }} card-title fw-bold">Atributos:</h5>
                            <ul class="list-group list-group-flush">
                                <li class="{{ session("tema") == "escuro" ? "cor_fontes_escuro bg-secondary" : "cor_fontes_claro bg-dark" }} list-group-item">🎯 Tipo de dano: {{ $personagem->tipo_dano }}</li>
                                <li class="{{ session("tema") == "escuro" ? "cor_fontes_escuro bg-secondary" : "cor_fontes_claro bg-dark" }} list-group-item">➡️ Alcance: {{ $personagem->alcance }} distância</li>
                                <li class="{{ session("tema") == "escuro" ? "cor_fontes_escuro bg-secondary" : "cor_fontes_claro bg-dark" }} list-group-item">❤️ Vida: {{ $personagem->vida }}</li>
                                <li class="{{ session("tema") == "escuro" ? "cor_fontes_escuro bg-secondary" : "cor_fontes_claro bg-dark" }} list-group-item">🔰 Defesa: {{ $personagem->defesa }}</li>
                            </ul>
                        </div>

                        <div class="card-body border-top {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }}">
                            <h5 class="cor_fontes_{{ session("tema") }} card-title fw-bold">🕹 Skills:</h5>
                            <ul class="list-group list-group-flush">
                                <li class="{{ session("tema") == "escuro" ? "cor_fontes_escuro bg-secondary" : "cor_fontes_claro bg-dark" }} list-group-item">1 - {{ $personagem->skill01?->skill }}</li>
                                <li class="{{ session("tema") == "escuro" ? "cor_fontes_escuro bg-secondary" : "cor_fontes_claro bg-dark" }} list-group-item">2 - {{ $personagem->skill02?->skill }}</li>
                                <li class="{{ session("tema") == "escuro" ? "cor_fontes_escuro bg-secondary" : "cor_fontes_claro bg-dark" }} list-group-item">3 - {{ $personagem->skill03?->skill }}</li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection