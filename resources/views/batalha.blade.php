@extends("layouts.main_layout")

@section("content")
    @include("layouts.partials.styles.estilos_batalha")

    <div class="d-flex justify-content-evenly text-center overflow-x-auto">
        <div class="cards_batalha card bg-transparent border border-0">
            <div class="card-header bg-transparent border border-0 h-100">
                <h4 class="d-flex justify-content-center text-success">
                    <img src="{{ asset(Auth::user()->foto) }}" class="perfil_player sombras border border-{{ $temas[1] }} rounded-circle">
                    <div class="border-3 border-start border-black rounded-top-1 ms-2">
                        <i class="fi fi-{{ strtolower(Auth::user()->pais) }} animate__animated animate__jello animate__infinite border-start border-end float-start me-2"></i>
                        <span>Você</span>
                    </div>
                </h4>
            </div>
            <div class="position-relative">
                <img src="{{ asset("assets/images/personagens/" . strtolower(Auth::user()->personagem->classe) . ".png") }}" id="player" class="card-img-top animate__animated
                    @if($batalha->inicio == false)
                        animate__fadeInLeftBig
                    @endif
                ">
                <img src="{{ asset("assets/images/magias/magia.gif") }}" id="magia_player" class="position-absolute top-50 start-50 magias w-50" hidden>
                <img src="{{ asset("assets/images/gifs/ataques/normal.gif") }}" id="efeito01_player" class="position-absolute top-50 start-50 translate-middle w-100" hidden>
                <img src="{{ asset("assets/images/gifs/ataques/forte.gif") }}" id="efeito02_player" class="position-absolute bottom-0 start-50 translate-middle-x" hidden>
                <img src="{{ asset("assets/images/gifs/ataques/ultimate.gif") }}" id="efeito03_player" class="position-absolute bottom-0 start-50 translate-middle-x" hidden>
            </div>
            <div class="card-body border border-0">
                <div class="barras card-title progress border border-danger bg-black mb-0" role="progressbar" aria-label="Animated striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                    <div id="hp" class="progress-bar progress-bar-striped progress-bar-animated bg-danger">
                        <label class="fw-bold fs-6">❤️ {{ $batalha->hp }}</label>
                    </div>
                </div>
                <small id="dano_oponente" class="animate__animated animate__fadeIn fw-bold text-{{ $tipo_dano["oponente"] }}" hidden></small>
            </div>
            <div class="card-footer border border-0">
                <form action="{{ route("atacar", ["batalha" => $batalha]) }}" method="POST" class="d-grid gap-2" novalidate>
                    @csrf

                    <div class="sombras btn-group animate__animated animate__fadeIn" role="group" aria-label="SkillsPlayer">
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" value="{{ Auth::user()->personagem->skill01->skill }}">
                        <label class="cursor d-grid btn cor_fontes_{{ $temas[2] }} bg-{{ $temas[0] }} btn-outline-{{ $temas[1] }}" for="btnradio1">
                            🕹
                            <span class="cursor">{{ Auth::user()->personagem->skill01->skill }}</span>
                        </label>
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" value="{{ Auth::user()->personagem->skill02->skill }}">
                        <label class="cursor d-grid btn cor_fontes_{{ $temas[2] }} bg-{{ $temas[0] }} btn-outline-{{ $temas[1] }}" for="btnradio2">
                            🕹
                            <span class="cursor">{{ Auth::user()->personagem->skill02->skill }}</span>
                        </label>
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" value="{{ Auth::user()->personagem->skill03->skill }}">
                        <label class="cursor d-grid btn cor_fontes_{{ $temas[2] }} bg-{{ $temas[0] }} btn-outline-{{ $temas[1] }}" for="btnradio3">
                            🕹
                            <span class="cursor">{{ Auth::user()->personagem->skill03->skill }}</span>
                        </label>
                    </div>
                    <div id="escolha" class="alert alert-danger animate__animated animate__shakeX bg-danger mb-0" role="alert" hidden>
                        <i class="bi bi-info-circle-fill me-3"></i>Escolha sua skill primeiro!
                    </div>

                    <button type="button" id="atacar" class="cursor sombras botoes animate__animated animate__fadeIn btn btn-lg focus-ring btn-{{ $temas[0] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} d-flex border">
                        <span class="cursor cor_fontes_{{ $temas[2] }} mx-auto">ATACAR! 🤜🏼</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="d-grid mx-3">
            <h4 class="cor_vez fw-bold">Vez:
                <br>
                <span id="vez" class="cor_vez"></span>
            </h4>
            <div>
                <h4 class="text-white">
                    <span id="minutos"></span>:<span id="segundos"></span>
                </h4>
                <h1 class="gifs animate__animated animate__fadeInDown position-relative my-auto">🆚</h1>
            </div>
            
            <div class="d-flex justify-content-center w-25 mx-auto">
                <h2 id="momento" class="animate__animated animate__pulse animate__flash animate__infinite text-warning">Momento Decisivo!</h2>
            </div>
        </div>

        <div class="cards_batalha card bg-transparent border border-0 h-100">
            <div class="card-header bg-transparent border border-0">
                <h4 class="d-flex justify-content-center text-danger">
                    <img src="
                        @if ($foto == "photos/vazio.png")
                            {{ asset($foto) }}
                        @else
                            {{ asset("assets/images/perfils/" . $foto) }}
                        @endif
                    " class="perfil_player sombras border border-{{ $temas[1] }} rounded-circle">
                    @if($nome != "Computador")
                        <div class="border-3 border-start border-black rounded-top-1 ms-2">
                            <i class="fi fi-{{ strtolower($bandeira_oponente) }} animate__animated animate__jello animate__infinite border-start border-end float-start me-2"></i>
                            <span>Oponente: {{ $nome }}</span>
                        </div>
                    @else
                        <div class="border-3 border-start border-black rounded-top-1 ms-2">
                            <i class="fi animate__animated animate__jello animate__infinite bg-secondary border-start border-end float-start me-2"></i>
                            <span class="d-flex">Oponente: Computador</span>
                        </div>
                    @endif
                </h4>
            </div>
            <div class="position-relative">
                <img src="{{ asset("assets/images/personagens/" . strtolower($oponente->classe) . "_reverso.png") }}" id="oponente" class="card-img-top animate__animated
                    @if($batalha->inicio == false)
                        animate__fadeInRightBig
                    @endif
                ">
                <img src="{{ asset("assets/images/magias/magia_reverso.gif") }}" id="magia_oponente" class="position-absolute top-50 start-50 magias w-50" hidden>
                <img src="{{ asset("assets/images/gifs/ataques/normal.gif") }}" id="efeito01_oponente" class="position-absolute top-50 start-50 translate-middle w-100" hidden>
                <img src="{{ asset("assets/images/gifs/ataques/forte.gif") }}" id="efeito02_oponente" class="position-absolute bottom-0 start-50 translate-middle-x" hidden>
                <img src="{{ asset("assets/images/gifs/ataques/ultimate.gif") }}" id="efeito03_oponente" class="position-absolute bottom-0 start-50 translate-middle-x" hidden>
            </div>
            <div class="card-body border border-0">
                <div class="barras card-title progress border border-danger bg-black mb-0" role="progressbar" aria-label="Animated striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                    <div id="hp_oponente" class="progress-bar progress-bar-striped progress-bar-animated bg-danger">
                        <label class="fw-bold fs-6">❤️ {{ $batalha->hp_oponente }}</label>
                    </div>
                </div>
                <small id="dano_player" class="animate__animated animate__fadeIn fw-bold text-{{ $tipo_dano["player"] }}" hidden></small>
            </div>
            <div class="card-footer border border-0">
                <div class="btn-group animate__animated animate__fadeIn" role="group">
                    <input type="radio" class="btn-check" autocomplete="off" value="{{ $oponente->skill01->skill }}" disabled>
                    <label class="d-grid btn cor_fontes_{{ $temas[2] }} bg-{{ $temas[0] }} btn-outline-{{ $temas[1] }}">
                        🕹
                        <span>{{ $oponente->skill01->skill }}</span>
                    </label>
                    <input type="radio" class="btn-check" autocomplete="off" value="{{ $oponente->skill02->skill }}" disabled>
                    <label class="d-grid btn cor_fontes_{{ $temas[2] }} bg-{{ $temas[0] }} btn-outline-{{ $temas[1] }}">
                        🕹
                        <span>{{ $oponente->skill02->skill }}</span>
                    </label>
                    <input type="radio" class="btn-check" autocomplete="off" value="{{ $oponente->skill03->skill }}" disabled>
                    <label class="d-grid btn cor_fontes_{{ $temas[2] }} bg-{{ $temas[0] }} btn-outline-{{ $temas[1] }}">
                        🕹
                        <span>{{ $oponente->skill03->skill }}</span>
                    </label>
                </div>

                <div hidden>
                    <form action="{{ route("ataque", ["id" => $batalha->oponente_id]) }}" method="POST">
                        @csrf

                        <button type="button" id="ataque"></a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include("layouts.partials.scripts.animacoes")
    @include("layouts.partials.scripts.batalha")
@endsection