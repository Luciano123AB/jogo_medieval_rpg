@extends("layouts.main_layout")

@section("content")
    @include("layouts.partials.styles.estilos_batalha")

    <div class="d-flex justify-content-evenly text-center overflow-x-auto">
        <div class="cards_batalha card bg-transparent border border-0">
            <div class="card-header bg-transparent border border-0 h-100">
                <h4 class="d-flex justify-content-center text-success">
                    <img src="
                        @if(session("player.foto") == "nenhuma")
                            {{ asset("assets/images/perfils/vazio.png") }}
                        @else
                            data:image/png;data:image/jpeg;base64,{{ session("player.foto") }}
                        @endif
                    " class="perfil_player sombras border border-{{ $temas[1] }} rounded-circle">
                    <div class="border-3 border-start border-black rounded-top-1 ms-2">
                        <i class="fi fi-{{ strtolower(session("player.pais")) }} animate__animated animate__jello animate__infinite border-start border-end float-start me-2"></i>
                        <span>Você</span>
                    </div>
                </h4>
            </div>
            <div class="position-relative">
                <img src="{{ asset("assets/images/personagens/" . strtolower(session("player.personagem.classe")) . ".png") }}" id="player" class="card-img-top animate__animated
                    @if(!session()->has("inicio_player"))
                        animate__fadeInLeftBig

                        {{ session(["inicio_player" => true]) }}
                    @endif
                ">
                <img src="{{ asset("assets/images/magias/magia.gif") }}" id="magia_player" class="position-absolute top-50 start-50 magias w-50" hidden>
                <img src="{{ asset("assets/images/gifs/ataques/normal.gif") }}" id="efeito01_player" class="position-absolute top-50 start-50 translate-middle w-100" hidden>
                <img src="{{ asset("assets/images/gifs/ataques/forte.gif") }}" id="efeito02_player" class="position-absolute bottom-0 start-50 translate-middle-x" hidden>
                <img src="{{ asset("assets/images/gifs/ataques/ultimate.gif") }}" id="efeito03_player" class="position-absolute bottom-0 start-50 translate-middle-x" hidden>
            </div>
            <div class="card-body border border-0">
                <div class="barras card-title progress border border-danger bg-black" role="progressbar" aria-label="Animated striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                    <div id="hp" class="progress-bar progress-bar-striped progress-bar-animated bg-danger">
                        <label class="fw-bold fs-6">❤️ {{ $batalha->hp }}</label>
                    </div>
                </div>
                @if (session("dano_desferido_oponente"))
                    @if (session("dano_critico"))
                        <small class="animate__animated animate__fadeIn fs-5 fw-bold text-danger">🎯 -{{ session('dano_desferido_oponente') }}</small>
                    @else
                        <small class="cor_fontes_claro animate__animated animate__fadeIn fw-bold">🎯 -{{ session('dano_desferido_oponente') }}</small>
                    @endif
                @endif
            </div>
            <div class="card-footer border border-0">
                <form action="{{ route("atacar") }}" method="POST" class="d-grid gap-2" novalidate>
                    @csrf

                    <div class="btn-group animate__animated animate__fadeIn" role="group" aria-label="SkillsPlayer">
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" value="{{ session("player.personagem.skill01.skill") }}">
                        <label class="cursor d-grid btn cor_fontes_{{ $temas[2] }} bg-{{ $temas[0] }} btn-outline-{{ $temas[1] }}" for="btnradio1">
                            🕹
                            <span class="cursor">{{ session("player.personagem.skill01.skill") }}</span>
                        </label>
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" value="{{ session("player.personagem.skill02.skill") }}">
                        <label class="cursor d-grid btn cor_fontes_{{ $temas[2] }} bg-{{ $temas[0] }} btn-outline-{{ $temas[1] }}" for="btnradio2">
                            🕹
                            <span class="cursor">{{ session("player.personagem.skill02.skill") }}</span>
                        </label>
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" value="{{ session("player.personagem.skill03.skill") }}">
                        <label class="cursor d-grid btn cor_fontes_{{ $temas[2] }} bg-{{ $temas[0] }} btn-outline-{{ $temas[1] }}" for="btnradio3">
                            🕹
                            <span class="cursor">{{ session("player.personagem.skill03.skill") }}</span>
                        </label>
                    </div>
                    @error("skill")
                        <div class="alert alert-danger animate__animated animate__shakeX bg-danger mb-0" role="alert">
                            <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                        </div>
                    @enderror

                    @if ($batalha->vez == 0)
                        <button id="atacar" class="cursor sombras botoes animate__animated animate__fadeIn btn btn-lg focus-ring btn-{{ $temas[0] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} d-flex border" type="submit">
                            <span class="cursor cor_fontes_{{ $temas[2] }} mx-auto">ATACAR! 🤜🏼</span>
                        </button>
                    @endif
                </form>
            </div>
        </div>

        <div class="d-grid mx-3">
            @if ($vez == 0)
                <h4 class="text-success fw-bold">Vez:
                    <br>
                    <span>Você</span>
                </h4>
            @else
                <h4 class="text-danger fw-bold">Vez:
                    <br>
                    <span>Oponente</span>
                </h4>
            @endif
            <div>
                <h4 class="text-white">
                    <span id="minutos"></span>:<span id="segundos"></span>
                </h4>
                <h1 class="gifs animate__animated animate__fadeInDown position-relative my-auto">🆚</h1>
            </div>
            <h2 id="alerta" class="animate__animated animate__pulse animate__flash animate__infinite text-warning"></h2>
        </div>

        <div class="cards_batalha card bg-transparent border border-0 h-100">
            <div class="card-header bg-transparent border border-0">
                <h4 class="d-flex justify-content-center text-danger">
                    <img src="
                        @if($foto == "nenhuma")
                            {{ asset("assets/images/perfils/vazio.png") }}
                        @else
                            data:image/png;data:image/jpeg;base64,{{ $foto }}
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
                    @if(!session()->has("inicio_oponente"))
                        animate__fadeInRightBig

                        {{ session(["inicio_oponente" => true]) }}
                    @endif
                ">
                <img src="{{ asset("assets/images/magias/magia_reverso.gif") }}" id="magia_oponente" class="position-absolute top-50 start-50 magias w-50" hidden>
                <img src="{{ asset("assets/images/gifs/ataques/normal.gif") }}" id="efeito01_oponente" class="position-absolute top-50 start-50 translate-middle w-100" hidden>
                <img src="{{ asset("assets/images/gifs/ataques/forte.gif") }}" id="efeito02_oponente" class="position-absolute bottom-0 start-50 translate-middle-x" hidden>
                <img src="{{ asset("assets/images/gifs/ataques/ultimate.gif") }}" id="efeito03_oponente" class="position-absolute bottom-0 start-50 translate-middle-x" hidden>
            </div>
            <div class="card-body border border-0">
                <div class="barras card-title progress border border-danger bg-black" role="progressbar" aria-label="Animated striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                    <div id="hp_oponente" class="progress-bar progress-bar-striped progress-bar-animated bg-danger">
                        <label class="fw-bold fs-6">❤️ {{ $batalha->hp_oponente }}</label>
                    </div>
                </div>
                @if (session("dano_desferido_player"))
                    @if (session("dano_critico"))
                        <small class="animate__animated animate__fadeIn fs-5 fw-bold text-danger">🎯 -{{ session('dano_desferido_player') }}</small>
                    @else
                        <small class="cor_fontes_claro animate__animated animate__fadeIn fw-bold">🎯 -{{ session('dano_desferido_player') }}</small>
                    @endif
                @endif
            </div>
            <div class="card-footer border border-0">
                <div class="btn-group animate__animated animate__fadeIn" role="group" aria-label="SkillsOponente">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off" value="{{ $oponente->skill01->skill }}" disabled>
                    <label class="d-grid btn cor_fontes_{{ $temas[2] }} bg-{{ $temas[0] }} btn-outline-{{ $temas[1] }}" for="btnradio4">
                        🕹
                        <span>{{ $oponente->skill01->skill }}</span>
                    </label>
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio5" autocomplete="off" value="{{ $oponente->skill02->skill }}" disabled>
                    <label class="d-grid btn cor_fontes_{{ $temas[2] }} bg-{{ $temas[0] }} btn-outline-{{ $temas[1] }}" for="btnradio5">
                        🕹
                        <span>{{ $oponente->skill02->skill }}</span>
                    </label>
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio6" autocomplete="off" value="{{ $oponente->skill03->skill }}" disabled>
                    <label class="d-grid btn cor_fontes_{{ $temas[2] }} bg-{{ $temas[0] }} btn-outline-{{ $temas[1] }}" for="btnradio6">
                        🕹
                        <span>{{ $oponente->skill03->skill }}</span>
                    </label>
                </div>

                <div hidden>
                    <a href="{{ route("ataque") }}" id="ataque" type="submit"></a>
                </div>
            </div>
        </div>
    </div>

    @include("layouts.partials.scripts.scripts_batalha")
    @include("layouts.partials.scripts.animacoes")
@endsection