@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="d-flex">
            <div class="text-center">
                <h4 class="d-flex justify-content-center text-success">
                    <img src="
                        @if(session("player.foto") == "nenhuma")
                            {{ asset("assets/images/perfils/vazio_perfil.png") }}
                        @else
                            data:image/png;data:image/jpeg;base64,{{ session("player.foto") }}
                        @endif
                    " class="perfil_player sombras border {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} rounded-circle">
                    <div class="border-3 border-start border-black rounded-top-1 ms-2">
                        <i class="fi fi-{{ strtolower(session("player.pais")) }} animate__animated animate__jello animate__infinite border-start border-end"></i>
                        Você
                    </div>
                </h4>
                <div class="position-relative">
                    <img src="{{ asset("assets/images/personagens/" . (session("player.personagem.classe")) . ".png") }}" id="player" class="animate__animated
                        @if(!session()->has("inicio_player"))
                            animate__fadeInLeftBig

                            {{ session(["inicio_player" => true]) }}
                        @endif
                    w-50">
                    <img src="{{ asset("assets/images/magias/magia.png") }}" id="magia_player" class="position-absolute top-50 start-50 magias w-50" hidden>
                </div>
                <div class="d-grid gap-2 w-50 mx-auto">
                    <div class="barras progress border border-danger bg-black" role="progressbar" aria-label="Animated striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                        <div id="hp" class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width: 100%"><label class="fw-bold fs-6">❤️ {{ $batalha->hp }}</label></div>
                    </div>
                    
                    @if (session("dano_desferido_oponente"))
                        @if (session("dano_critico"))
                            <small class="fs-5 fw-bold text-danger">🎯 -{{ session('dano_desferido_oponente') }}</small>
                        @else
                            <small class="cor_fontes_claro fw-bold">🎯 -{{ session('dano_desferido_oponente') }}</small>
                        @endif
                    @endif
                    
                    <form action="{{ route("atacar") }}" method="POST" class="d-grid gap-2" novalidate>
                        @csrf

                        <div class="btn-group animate__animated animate__fadeIn" role="group" aria-label="SkillsPlayer">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" value="{{ session("player.personagem.skill01.skill") }}">
                            <label class="cursor d-grid btn {{ session("tema") == "escuro" ? "cor_fontes_escuro bg-secondary btn-outline-primary" : "cor_fontes_claro bg-dark btn-outline-danger" }}" for="btnradio1">🕹 <span class="cursor">{{ session("player.personagem.skill01.skill") }}</span></label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" value="{{ session("player.personagem.skill02.skill") }}">
                            <label class="cursor d-grid btn {{ session("tema") == "escuro" ? "cor_fontes_escuro bg-secondary btn-outline-primary" : "cor_fontes_claro bg-dark btn-outline-danger" }}" for="btnradio2">🕹 <span class="cursor">{{ session("player.personagem.skill02.skill") }}</span></label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" value="{{ session("player.personagem.skill03.skill") }}">
                            <label class="cursor d-grid btn {{ session("tema") == "escuro" ? "cor_fontes_escuro bg-secondary btn-outline-primary" : "cor_fontes_claro bg-dark btn-outline-danger" }}" for="btnradio3">🕹 <span class="cursor">{{ session("player.personagem.skill03.skill") }}</span></label>
                        </div>
                        @error("skill")
                            <div class="alert alert-danger animate__animated animate__shakeX mb-0" role="alert">
                                <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                            </div>
                        @enderror

                        @if ($batalha->vez == 0)
                            <button id="atacar" class="cursor sombras botoes animate__animated animate__fadeIn btn btn-lg {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} d-flex border" type="submit">
                                <span class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }} mx-auto">ATACAR! 🤜🏼</span>
                            </button>
                        @endif
                    </form>
                </div>
            </div>

            <div class="d-grid text-center">
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
                <h1 class="animate__animated animate__fadeInDown my-auto">🆚</h1>
                <h2 id="alerta" class="animate__animated animate__pulse animate__flash animate__infinite text-warning"></h2>
            </div>

            <div class="text-center">
                <h4 class="d-flex justify-content-center text-danger">
                    <img src="
                        @if($foto == "nenhuma")
                            {{ asset("assets/images/perfils/vazio_perfil.png") }}
                        @else
                            data:image/png;data:image/jpeg;base64,{{ $foto }}
                        @endif
                    " class="perfil_player sombras border {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} rounded-circle">
                    @if($nome != "Computador")
                        <div class="border-3 border-start border-black rounded-top-1 ms-2">
                            <i class="fi fi-{{ strtolower($bandeira_oponente) }} animate__animated animate__jello animate__infinite border-start border-end"></i>
                            Oponente: {{ $nome }}
                        </div>
                    @else
                        <div class="border-3 border-start border-black ms-2">
                            <i class="fi animate__animated animate__jello animate__infinite bg-secondary border-start border-end"></i>
                            Oponente: Computador
                        </div>
                    @endif                    
                </h4>
                <div class="position-relative">
                    <img src="{{ asset("assets/images/personagens/$oponente->classe" . "_reverso.png") }}" id="oponente" class="animate__animated
                        @if(!session()->has("inicio_oponente"))
                            animate__fadeInRightBig

                            {{ session(["inicio_oponente" => true]) }}
                        @endif
                    w-50">
                    <img src="{{ asset("assets/images/magias/magia_reverso.png") }}" id="magia_oponente" class="position-absolute top-50 start-50 magias w-50" hidden>
                </div>
                <div class="d-grid gap-2 w-50 mx-auto">
                    <div class="barras progress border border-danger bg-black" role="progressbar" aria-label="Animated striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                        <div id="hp_oponente" class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width: 100%"><label class="fw-bold fs-6">❤️ {{ $batalha->hp_oponente }}</label></div>
                    </div>

                    @if (session("dano_desferido_player"))
                        @if (session("dano_critico"))
                            <small class="fs-5 fw-bold text-danger">🎯 -{{ session('dano_desferido_player') }}</small>
                        @else
                            <small class="cor_fontes_claro fw-bold">🎯 -{{ session('dano_desferido_player') }}</small>
                        @endif
                    @endif

                    <div class="btn-group animate__animated animate__fadeIn" role="group" aria-label="SkillsOponente">
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off" value="{{ $oponente->skill01->skill }}" disabled>
                        <label class="d-grid btn {{ session("tema") == "escuro" ? "cor_fontes_escuro bg-secondary btn-outline-primary" : "cor_fontes_claro bg-dark btn-outline-danger" }}" for="btnradio4">🕹 <span>{{ $oponente->skill01->skill }}</span></label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio5" autocomplete="off" value="{{ $oponente->skill02->skill }}" disabled>
                        <label class="d-grid btn {{ session("tema") == "escuro" ? "cor_fontes_escuro bg-secondary btn-outline-primary" : "cor_fontes_claro bg-dark btn-outline-danger" }}" for="btnradio5">🕹 <span>{{ $oponente->skill02->skill }}</span></label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio6" autocomplete="off" value="{{ $oponente->skill03->skill }}" disabled>
                        <label class="d-grid btn {{ session("tema") == "escuro" ? "cor_fontes_escuro bg-secondary btn-outline-primary" : "cor_fontes_claro bg-dark btn-outline-danger" }}" for="btnradio6">🕹 <span>{{ $oponente->skill03->skill }}</span></label>
                    </div>

                    <div hidden>
                        <a href="{{ route("ataque") }}" id="ataque" type="submit"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        const player = document.getElementById("player");
        const oponete = document.getElementById("oponente");

        function getCentroElemento(el) {

            const rect = el.getBoundingClientRect();

            return {
                x: rect.left + rect.width / 2,
                y: rect.top  + rect.height / 2
            };
        }

        const centroPlayer   = getCentroElemento(player);
        const centroOponente = getCentroElemento(oponente);

        let distanciaRealX = centroOponente.x - centroPlayer.x;
        let distanciaRealY = centroOponente.y - centroPlayer.y;

        function atualizarDistancias() {
            const centroPlayer   = getCentroElemento(player);
            const centroOponente = getCentroElemento(oponente);

            distanciaRealX = centroOponente.x - centroPlayer.x;
            distanciaRealY = centroOponente.y - centroPlayer.y;
        };
        atualizarDistancias();
        window.addEventListener("resize", atualizarDistancias);

        const skill01 = document.getElementById("btnradio1");
        const skill02 = document.getElementById("btnradio2");
        const skill03 = document.getElementById("btnradio3");

        const atacar = document.getElementById("atacar");
        const atacar_oponente = document.getElementById("atacar_oponente");

        const magia_player = document.getElementById("magia_player");
        const magia_oponente = document.getElementById("magia_oponente");

        @if($batalha->vez == 1)
            skill01.disabled = true;
            skill02.disabled = true;
            skill03.disabled = true;
            setTimeout(() => {
                document.getElementById("ataque").click();
            }, 3000);
        @else
            skill01.disabled = false;
            skill02.disabled = false;
            skill03.disabled = false;
        @endif

        @if(session()->has("skill01"))
            skill01.disabled = true;
        @endif

        @if(session()->has("skill02"))
            skill02.disabled = true;
        @endif

        @if(session()->has("skill03"))
            skill03.disabled = true;
        @endif

        const gtl = gsap.timeline();
        let distancia_player = [0, 0];
        let distancia_oponente = [0, 0];

        @if(session("player.personagem.classe") == "Mago")
            distancia_player = [50, 100];
        @else
            distancia_player = [250, distanciaRealX * 0.7];
        @endif

        @if($oponente->classe == "Mago")
            distancia_oponente = [50, 100];
        @else
            distancia_oponente = [250, distanciaRealX * 0.7];
        @endif

        @if(session("dano_desferido_player"))
            player.src = "{{ asset('assets/images/personagens_ataque/' . session('player.personagem.classe') . '.png') }}";

            @if(session("player.personagem.classe") == "Mago")
                magia_player.hidden = false;
                magia_player.style.display = "block";

                gsap.set("#magia_player", {x: 0, y: 0});
                gtl.to("#magia_player", {
                    x: distanciaRealX - 85,
                    y: distanciaRealY,
                    duration: 0.5,
                    ease: "power1.inOut"
                });

                setTimeout(() => {
                    magia_player.hidden = true;
                }, 1200);
            @endif
            
            @if(session()->has("ultimate_player"))
                gtl.to("#player", {
                    duration: 0.9,
                    ease: "power1.inOut",
                    motionPath: {
                        path: [
                            {x: 0, y: 0},
                            {x: distancia_player[0], y: -250},
                            {x: distancia_player[1], y: 0}
                        ],
                        curviness: 1.5
                    }
                })
                .to("#player", {
                    x: 0,
                    y: 0,
                    duration: 0.7,
                    ease: "power2.in"
                });

                setTimeout(() => {
                    oponete.classList.add("animate__rubberBand");
                    oponente.src = "{{ asset('assets/images/personagens_dano/' . $oponente->classe . '_reverso.png') }}";
                }, 900);
            @elseif(session()->has("forte_player"))
                gtl.to("#player", {
                    duration: 0.9,
                    ease: "power1.inOut",
                    motionPath: {
                        path: [
                            {x: 250, y: 0},
                            {x: distancia_player[0], y: -250},
                            {x: distancia_player[1], y: 0}
                        ],
                        curviness: 1.5
                    }
                })
                .to("#player", {
                    x: 0,
                    y: 0,
                    duration: 0.7,
                    ease: "power2.in"
                });

                setTimeout(() => {
                    oponete.classList.add("animate__shakeX");
                    oponente.src = "{{ asset('assets/images/personagens_dano/' . $oponente->classe . '_reverso.png') }}";
                }, 900);
            @else
                setTimeout(() => {
                    oponente.src = "{{ asset('assets/images/personagens_dano/' . $oponente->classe . '_reverso.png') }}";
                }, 900);

                gtl.fromTo("#player", {
                    x: 0,
                    y: 0
                }, {
                    x: distancia_player[1],
                    y: 0,
                    duration: 0.9,
                    ease: "power1.in"
                })

                .fromTo("#oponente", {
                    x: 0,
                    y: 0
                }, {
                    x: 150,
                    y: 0,
                    duration: 0.5,
                    ease: "power2.in"
                })

                .to("#player", {
                    x: 0,
                    y: 0,
                    duration: 0.7,
                    ease: "power2.in"
                })

                .to("#oponente", {
                    x: 0,
                    y: 0,
                    duration: 0.7,
                    ease: "power1.in"
                });
            @endif
        @endif

        @if(session("dano_desferido_oponente"))
            oponente.src = "{{ asset('assets/images/personagens_ataque/' . $oponente->classe . '_reverso.png') }}";

            @if($oponente->classe == "Mago")
                magia_oponente.hidden = false;
                magia_oponente.style.display = "block";

                gsap.set("#magia_oponente", {x: 0, y: 0 - 100});
                gsap.to("#magia_oponente", {
                    x: -distanciaRealX - 70,
                    y: -distanciaRealY - 100,
                    duration: 0.5,
                    ease: "power1.inOut"
                });

                setTimeout(() => {
                    magia_oponente.hidden = true;
                }, 1200);
            @endif

            @if(session()->has("ultimate_oponente"))
                gtl.to("#oponente", {
                    duration: 0.9,
                    ease: "power1.inOut",
                    motionPath: {
                        path: [
                            {x: 0, y: 0},
                            {x: -distancia_oponente[0], y: -250},
                            {x: -distancia_oponente[1], y: 0}
                        ],
                        curviness: 1.5
                    }
                })
                .to("#oponente", {
                    x: 0,
                    y: 0,
                    duration: 0.7,
                    ease: "power2.in"
                });

                setTimeout(() => {
                    player.classList.add("animate__rubberBand");
                    player.src = "{{ asset('assets/images/personagens_dano/' . session('player.personagem.classe') . '.png') }}";
                }, 900);

                setTimeout(() => {
                    oponente.src = "{{ asset('assets/images/personagens/' . $oponente->classe . '_reverso.png') }}";
                    player.src = "{{ asset('assets/images/personagens/' . session('player.personagem.classe') . '.png') }}";
                }, 1600);
            @elseif(session()->has("forte_oponente"))
                gtl.to("#oponente", {
                    duration: 0.9,
                    ease: "power1.inOut",
                    motionPath: {
                        path: [
                            {x: -250, y: 0},
                            {x: -distancia_oponente[0], y: -250},
                            {x: -distancia_oponente[1], y: 0}
                        ],
                        curviness: 1.5
                    }
                })
                .to("#oponente", {
                    x: 0,
                    y: 0,
                    duration: 0.7,
                    ease: "power2.in"
                });

                setTimeout(() => {
                    player.classList.add("animate__shakeX");
                    player.src = "{{ asset('assets/images/personagens_dano/' . session('player.personagem.classe') . '.png') }}";
                }, 900);

                setTimeout(() => {
                    oponente.src = "{{ asset('assets/images/personagens/' . $oponente->classe . '_reverso.png') }}";
                    player.src = "{{ asset('assets/images/personagens/' . session('player.personagem.classe') . '.png') }}";
                }, 1600);
            @else
                setTimeout(() => {
                    player.src = "{{ asset('assets/images/personagens_dano/' . session('player.personagem.classe') . '.png') }}";
                }, 900);

                gtl.fromTo("#oponente", {
                    x: 0,
                    y: 0
                }, {
                    x: -distancia_oponente[1],
                    y: 0,
                    duration: 0.9,
                    ease: "power1.in"
                })

                .fromTo("#player", {
                    x: 0,
                    y: 0
                }, {
                    x: -150,
                    y: 0,
                    duration: 0.5,
                    ease: "power2.in"
                })

                .to("#oponente", {
                    x: 0,
                    y: 0,
                    duration: 0.7,
                    ease: "power2.in"
                })

                .to("#player", {
                    x: 0,
                    y: 0,
                    duration: 0.7,
                    ease: "power1.in"
                });

                setTimeout(() => {
                    oponente.src = "{{ asset('assets/images/personagens/' . $oponente->classe . '_reverso.png') }}";
                    player.src = "{{ asset('assets/images/personagens/' . session('player.personagem.classe') . '.png') }}";
                }, 2800);
            @endif
        @endif

        const hp_player = {{ $batalha->hp }};
        const hp_maximo_player = {{ session("dados.hp_maximo") }};
        const hp_barra_player = document.getElementById("hp");

        const hp_oponente = {{ $batalha->hp_oponente }};
        const hp_maximo_oponente = {{ session("dados.hp_oponente_maximo") }};
        const hp_barra_oponente = document.getElementById("hp_oponente");

        function calcularPorcentagem(atual, maximo) {
            return (atual / maximo) * 100;
        }

        hp_barra_player.style.width = calcularPorcentagem(hp_player, hp_maximo_player) + "%";
        hp_barra_oponente.style.width = calcularPorcentagem(hp_oponente, hp_maximo_oponente) + "%";

        const alerta = document.getElementById("alerta");

        if (calcularPorcentagem(hp_player, hp_maximo_player) <= 10 || calcularPorcentagem(hp_oponente, hp_maximo_oponente) <= 10) {
            alerta.textContent = "Momento Decisivo!";
        }
    </script>
@endsection