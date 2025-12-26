@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="fundos_card_{{ $temas[4] }} card p-3">
            <div class="d-flex gap-3">
                <div class="animate__animated animate__fadeInLeft w-75">
                    <h1 class="titulos_{{ $temas[4] }} cor_fontes_{{ $temas[4] }} text-center fw-bold">Seu Personagem:</h1>
                    <div class="cards sombras card bg-{{ $temas[0] }} border-{{ $temas[1] }}">
                        <div class="card-header text-center border-bottom border-{{ $temas[1] }}">
                            <h3 class="cor_fontes_{{ $temas[4] }} card-title">
                                @if($classe == "Guerreiro")
                                    🛡️
                                @elseif($classe == "Mago")
                                    🔮
                                @else
                                    🗡️
                                @endif
                                <span class="titulos_{{ $temas[4] }}">{{ $classe }}</span>
                            </h3>
                            <label class="{{ $temas[2] }} fs-4">Nível: {{ $nivel }}</label>
                        </div>

                        <img src="{{ asset("assets/images/personagens/" . strtolower($classe) . ".png") }}" class="card-img-top border-bottom border-{{ $temas[1] }}">
                    </div>
                </div>

                <div id="oponentes" class="animate__animated animate__fadeInRight">
                    <h1 class="titulos_{{ $temas[4] }} cor_fontes_{{ $temas[4] }} text-center fw-bold">Oponentes:</h1>
                    <form action="{{ route("confirmarBatalha") }}" class="d-grid gap-3">
                        @foreach ($personagens as $personagem)
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
                                    <label class="{{ $temas[2] }}">Nível: {{ $nivel }}</label>
                                </div>

                                <img src="{{ asset("assets/images/personagens/" . strtolower($personagem->classe) . "_reverso.png") }}" class="card-img-top border-bottom border-{{ $temas[1] }}">

                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input cursor focus-ring border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} my-2 me-1" type="radio" name="oponente" value="{{ $personagem->id }}" id="oponente{{ $loop->index + 1 }}">
                                    <label class="form-check-label pt-1" for="oponente{{ $loop->index + 1 }}">
                                        <span class="cursor cor_fontes_{{ $temas[4] }}">SELECIONAR</span>
                                    </label>
                                </div>
                            </div>
                        @endforeach

                        <div>
                            @error("oponente")
                                <div class="d-flex justify-content-center">
                                    <div class="alert alert-danger animate__animated animate__shakeX bg-danger text-center" role="alert">
                                        <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                    </div>
                                </div>
                            @enderror

                            <button type="submit" class="cursor sombras botoes animate__animated animate__fadeIn btn focus-ring btn-{{ $temas[3] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} w-100">
                                <span class="cursor cor_fontes_{{ $temas[4] }}">Batalhar!</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>            
        </div>
    </div>
@endsection