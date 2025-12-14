@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="{{ session("tema") == "escuro" ? "fundos_card_claro" : "fundos_card_escuro" }} card p-3">
            <div class="d-flex gap-3">
                <div class="animate__animated animate__fadeInLeft w-75">
                    <h1 class="{{ session("tema") == "escuro" ? "titulos_escuro" : "titulos_claro" }} {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }} text-center fw-bold">Seu Personagem:</h1>
                    <div class="cards sombras card {{ session("tema") == "escuro" ? "bg-secondary border-primary" : "bg-dark border-danger" }}">
                        <div class="card-header text-center border-bottom {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }}">
                            <h3 class="{{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }} card-title">
                                @if($classe == "Guerreiro")
                                    🛡️
                                @elseif($classe == "Mago")
                                    🔮
                                @else
                                    🗡️
                                @endif
                                <span class="{{ session("tema") == "escuro" ? "titulos_escuro" : "titulos_claro" }}">{{ $classe }}</span>
                            </h3>
                            <label class="{{ session("tema") == "escuro" ? "cor_niveis" : "text-danger" }} fs-4">Nível: {{ $nivel }}</label>
                        </div>

                        <img src="{{ asset("assets/images/personagens/" . strtolower($classe) . ".png") }}" class="card-img-top border-bottom {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }}">
                    </div>
                </div>

                <div id="oponentes" class="animate__animated animate__fadeInRight">
                    <h1 class="{{ session("tema") == "escuro" ? "titulos_escuro" : "titulos_claro" }} {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }} text-center fw-bold">Oponentes:</h1>
                    <form action="{{ route("confirmarBatalha") }}" class="d-grid gap-3">
                        @foreach ($personagens as $personagem)
                            <div class="cards sombras card {{ session("tema") == "escuro" ? "bg-secondary border-primary" : "bg-dark border-danger" }}">
                                <div class="card-header text-center border-bottom {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }}">
                                    <h4 class="{{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }} card-title">
                                        @if($personagem->classe == "Guerreiro")
                                            🛡️
                                        @elseif($personagem->classe == "Mago")
                                            🔮
                                        @else
                                            🗡️
                                        @endif
                                        <span class="{{ session("tema") == "escuro" ? "titulos_escuro" : "titulos_claro" }}">{{ $personagem->classe }}</span>
                                    </h4>
                                    <label class="{{ session("tema") == "escuro" ? "cor_niveis" : "text-danger" }}">Nível: {{ $nivel }}</label>
                                </div>
                                
                                <img src="{{ asset("assets/images/personagens/" . strtolower($personagem->classe) . "_reverso.png") }}" class="card-img-top border-bottom {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }}">

                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input cursor {{ session("tema") == "escuro" ? "border-primary focus-ring focus-ring-primary" : "border-danger focus-ring focus-ring-danger" }} my-2 me-1" type="radio" name="oponente" value="{{ $personagem->id }}" id="oponente{{ $loop->index + 1 }}">
                                    <label class="form-check-label" for="oponente{{ $loop->index + 1 }}">
                                        <span class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }} align-middle">SELECIONAR</span>
                                    </label>
                                </div>
                            </div>
                        @endforeach

                        <div>
                            @error("oponente")
                                <div class="d-flex justify-content-center">
                                    <div class="alert alert-danger animate__animated animate__shakeX text-center" role="alert">
                                        <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                    </div>
                                </div>
                            @enderror
    
                            <button type="submit" class="cursor sombras botoes animate__animated animate__fadeIn btn {{ session("tema") == "escuro" ? "btn-light border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} w-100">
                                <span class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}">Batalhar!</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>            
        </div>
    </div>
@endsection