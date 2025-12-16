@php
    $tempo = Cache::get("batalha_tempo_" . session("dados.id_batalha"), [
        "segundos01" => 0,
        "segundos02" => 0,
        "minutos" => 0
    ]);
@endphp

<script>

    let segundos01 = {{ $tempo["segundos01"] ?? 0 }};
    let segundos02 = {{ $tempo["segundos02"] ?? 0 }};
    let minutos = {{ $tempo["minutos"] ?? 0 }};

    function atualizar() {
        document.getElementById("segundos01").innerText = segundos01;
        document.getElementById("segundos02").innerText = segundos02;
        document.getElementById("minutos").innerText = minutos;

        fetch("atualizar_tempo", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ segundos01, segundos02, minutos })
        });

        segundos01++;

        if (segundos01 >= 10) {
            segundos01 = 0;
            segundos02++;
        }

        if (segundos02 >= 6 && segundos01 >= 0) {
            segundos01 = 0;
            segundos02 = 0;
            minutos++
        }

        setTimeout(atualizar, 1000);
    }

    atualizar();

    const player = document.getElementById("player");
    const oponente = document.getElementById("oponente");

    function getCentroElemento(el) {

        const rect = el.getBoundingClientRect();

        return {
            x: rect.left + rect.width / 2,
            y: rect.top + rect.height / 2
        };
    }

    const centroPlayer = getCentroElemento(player);
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

    const som_ataque = document.getElementById("som_ataque");

    @if(session()->has("normal_player") || session()->has("normal_oponente") || session()->has("forte_player") || session()->has("forte_oponente") || session()->has("ultimate_player") || session()->has("ultimate_oponente"))
        som_ataque.muted = false;
        som_ataque.play().catch(error => {
            console.error("Erro ao reproduzir o áudio de ataque:", error);
        });
    @else
        som_ataque.muted = true;
    @endif

    @if($batalha->vez == 1)
        skill01.disabled = true;
        skill02.disabled = true;
        skill03.disabled = true;

        @if(session()->has("normal_player"))
            setTimeout(() => {
                document.getElementById("ataque").click();
            }, 2800);
        @elseif(session()->has("forte_player") || session()->has("ultimate_player"))
            setTimeout(() => {
                document.getElementById("ataque").click();
            }, 1900);
        @else
            setTimeout(() => {
                document.getElementById("ataque").click();
            }, 3000);
        @endif
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

    const efeito01_player = document.getElementById("efeito01_player");
    const efeito02_player = document.getElementById("efeito02_player");
    const efeito03_player = document.getElementById("efeito03_player");
    const efeito01_oponente = document.getElementById("efeito01_oponente");
    const efeito02_oponente = document.getElementById("efeito02_oponente");
    const efeito03_oponente = document.getElementById("efeito03_oponente");

    @if(session("dano_desferido_player"))
        player.src = "{{ asset('assets/images/personagens_ataque/' . strtolower(session('player.personagem.classe')) . '.png') }}";

        @if(session("player.personagem.classe") == "Mago")
            magia_player.hidden = false;
            magia_player.style.display = "block";

            gsap.set("#magia_player", {x: 0, y: 0});
            gtl.to("#magia_player", {
                x: distanciaRealX - 140,
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
                efeito03_oponente.hidden = false;
            }, 900);
            setTimeout(() => {
                efeito03_oponente.hidden = true;
            }, 1500);

            setTimeout(() => {
                oponente.classList.add("animate__rubberBand");
                oponente.src = "{{ asset('assets/images/personagens_dano/' . strtolower($oponente->classe) . '_reverso.png') }}";
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
                efeito02_oponente.hidden = false;
            }, 900);
            setTimeout(() => {
                efeito02_oponente.hidden = true;
            }, 1200);

            setTimeout(() => {
                oponente.classList.add("animate__shakeX");
                oponente.src = "{{ asset('assets/images/personagens_dano/' . strtolower($oponente->classe) . '_reverso.png') }}";
            }, 900);
        @else
            setTimeout(() => {
                oponente.src = "{{ asset('assets/images/personagens_dano/' . strtolower($oponente->classe) . '_reverso.png') }}";
            }, 900);

            gtl.fromTo("#player", {
                x: 0,
                y: 0
            }, {
                x: distancia_player[1],
                y: 0,
                duration: 0.5,
                ease: "power2.in"
            })
            .fromTo("#oponente", {
                x: 0,
                y: 0
            }, {
                x: 150,
                y: 0,
                duration: 0.5
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

            setTimeout(() => {
                efeito01_oponente.hidden = false;
            }, 500);
            setTimeout(() => {
                efeito01_oponente.hidden = true;
            }, 1100);
        @endif
    @endif

    @if(session("dano_desferido_oponente"))
        oponente.src = "{{ asset('assets/images/personagens_ataque/' . strtolower($oponente->classe) . '_reverso.png') }}";

        @if($oponente->classe == "Mago")
            magia_oponente.hidden = false;
            magia_oponente.style.display = "block";

            gsap.set("#magia_oponente", {x: 0, y: 0});
            gsap.to("#magia_oponente", {
                x: -distanciaRealX + 140,
                y: -distanciaRealY,
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
                efeito03_player.hidden = false;
            }, 900);
            setTimeout(() => {
                efeito03_player.hidden = true;
            }, 1500);

            setTimeout(() => {
                player.classList.add("animate__rubberBand");
                player.src = "{{ asset('assets/images/personagens_dano/' . strtolower(session('player.personagem.classe')) . '.png') }}";
            }, 900);

            setTimeout(() => {
                oponente.src = "{{ asset('assets/images/personagens/' . strtolower($oponente->classe) . '_reverso.png') }}";
                player.src = "{{ asset('assets/images/personagens/' . strtolower(session('player.personagem.classe')) . '.png') }}";
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
                efeito02_player.hidden = false;
            }, 900);
            setTimeout(() => {
                efeito02_player.hidden = true;
            }, 1200);

            setTimeout(() => {
                player.classList.add("animate__shakeX");
                player.src = "{{ asset('assets/images/personagens_dano/' . strtolower(session('player.personagem.classe')) . '.png') }}";
            }, 900);

            setTimeout(() => {
                oponente.src = "{{ asset('assets/images/personagens/' . strtolower($oponente->classe) . '_reverso.png') }}";
                player.src = "{{ asset('assets/images/personagens/' . strtolower(session('player.personagem.classe')) . '.png') }}";
            }, 1600);
        @else
            setTimeout(() => {
                player.src = "{{ asset('assets/images/personagens_dano/' . strtolower(session('player.personagem.classe')) . '.png') }}";
            }, 900);

            gtl.fromTo("#oponente", {
                x: 0,
                y: 0
            }, {
                x: -distancia_oponente[1],
                y: 0,
                duration: 0.5,
                ease: "power2.in"
            })
            .fromTo("#player", {
                x: 0,
                y: 0
            }, {
                x: -150,
                y: 0,
                duration: 0.5
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
                efeito01_player.hidden = false;
            }, 500);
            setTimeout(() => {
                efeito01_player.hidden = true;
            }, 1100);

            setTimeout(() => {
                oponente.src = "{{ asset('assets/images/personagens/' . strtolower($oponente->classe) . '_reverso.png') }}";
                player.src = "{{ asset('assets/images/personagens/' . strtolower(session('player.personagem.classe')) . '.png') }}";
            }, 2500);
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