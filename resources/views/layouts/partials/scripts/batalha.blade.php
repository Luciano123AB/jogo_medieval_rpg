@php
    $tempo = Cache::get("batalha_tempo_" . session("id_batalha"), [
        "segundos" => 0,
        "minutos" => 0
    ]);

    $temas = ["#f8f9fa", "primary", "#493722", "secondary", "escuro"];
    
    if (session("tema") == "claro" || !session()->has("tema")) {
        $temas = ["#323232", "danger", "#e5a350", "danger", "claro"];
    }
@endphp

<script>

    let segundos = {{ $tempo["segundos"] ?? 0 }};
    let minutos = {{ $tempo["minutos"] ?? 0 }};

    function atualizar() {
        document.getElementById("segundos").innerText = String(segundos).padStart(2, "0");
        document.getElementById("minutos").innerText = minutos;

        segundos++;

        if (segundos == 60) {
            segundos = 0;
            minutos++
        }

        setTimeout(atualizar, 1000);
    }

    function salvar() {
        fetch("atualizar_tempo", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ segundos, minutos })
        });
    }

    atualizar();

    function checkOrientation() {
        if (window.innerHeight > window.innerWidth) {
            Swal.fire({
                position: "center",
                draggable: true,
                showCloseButton: true,
                showConfirmButton: false,
                theme: "dark",
                background: "{{ $temas[0] }}",
                imageUrl: "{{ asset('assets/images/icones/icone.png') }}",
                imageHeight: 150,
                customClass: {
                    image: "animate__animated animate__flipOutY animate__infinite"
                },
                title: "<label class='d-grid gap-3 py-2'>" +
                            "<span class='titulos_{{ $temas[4] }} cor_fontes_{{ $temas[4] }} border-{{ $temas[1] }} border-top border-bottom py-3'>" +
                                "Virar Dispositivo!" +
                            "</span>" +
                            "<span class='cor_fontes_{{ $temas[4] }} d-flex justify-content-center fs-5'>" +
                                "<div class='cursor animate__animated animate__swing animate__infinite'>" +
                                    "<i class='cursor bi {{ session('alerta_resultado.icone') }} me-1'></i>" +
                                "</div>" +
                                "Por favor, para uma melhor esperiência, vira a tela do seu dispositivo." +
                            "</span>" +
                        "</label>",
                footer: "<button style='--bs-icon-link-transform: translate3d(0, -.125rem, 0); border-color: {{ $temas[2] }};' id='ok' class='cursor sombras botoes animate__animated animate__fadeIn btn focus-ring {{ $temas[4] == 'escuro' ? 'btn-secondary focus-ring-primary' : 'btn-danger focus-ring-danger' }} btn-sm rounded-pill'>" +
                            "<span style='color: {{ $temas[2] }}' id='ok' class='cursor d-flex justify-content-center'>" +
                                "<div id='ok' class='cursor animate__animated animate__bounceIn animate__infinite'>" +
                                    "<i id='ok' class='cursor bi bi-check-circle-fill me-1'></i>" +
                                "</div>" +
                                "OK" +
                            "</span>" +
                        "</button>",
                showClass: {
                    popup: `
                        animate__animated
                        animate__fadeInUp
                        animate__faster
                    `
                },
                hideClass: {
                    popup: `
                        animate__animated
                        animate__fadeOutDown
                        animate__faster
                    `
                },
                backdrop: `
                    rgba(0, 0, 0, 0.4)
                    url("/images/nyan-cat.gif")
                    left top
                    no-repeat
                `,
            });
        }
    }

    const tela_cheia = document.getElementById("tela_cheia");
    const icone_tela = document.getElementById("icone_tela_cheia");

    tela_cheia.addEventListener("click", function() {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen();
            icone_tela.classList.remove("bi-arrows-angle-expand");
            icone_tela.classList.add("bi-arrows-angle-contract");
        } else {
            document.exitFullscreen();
            icone_tela.classList.remove("bi-arrows-angle-contract");
            icone_tela.classList.add("bi-arrows-angle-expand");
        }
    });

    window.addEventListener("resize", checkOrientation);
    window.addEventListener("load", checkOrientation);

    const skill01 = document.getElementById("btnradio1");
    const skill02 = document.getElementById("btnradio2");
    const skill03 = document.getElementById("btnradio3");

    const atacar = document.getElementById("atacar");
    const ataque = document.getElementById("ataque");

    let hp_player = {{ $batalha->hp }};
    let hp_maximo_player = {{ $batalha->hp_maximo }};
    let hp_oponente = {{ $batalha->hp_oponente }};
    let hp_maximo_oponente = {{ $batalha->hp_maximo_oponente }};

    document.getElementById("hp").style.width = calcularPorcentagem(hp_player, hp_maximo_player) + "%";
    document.getElementById("hp_oponente").style.width = calcularPorcentagem(hp_oponente, hp_maximo_oponente) + "%";

    function calcularPorcentagem(atual, maximo) {
        return (atual / maximo) * 100;
    }

    const indicar_vez = document.getElementById("vez");
    const cor_vez = document.querySelectorAll(".cor_vez");
    let vez = {{ $batalha->vez }};
    let skill01Disponivel = {{ $batalha->skill01 ? 'true' : 'false' }};
    let skill02Disponivel = {{ $batalha->skill02 ? 'true' : 'false' }};
    let skill03Disponivel = {{ $batalha->skill03 ? 'true' : 'false' }};

    function atualizarMomento() {

        const momento = document.getElementById("momento");

        if (
            calcularPorcentagem(hp_player, hp_maximo_player) <= 10 ||
            calcularPorcentagem(hp_oponente, hp_maximo_oponente) <= 10
        ) {
            momento.hidden = false;
        } else {
            momento.hidden = true;
        }
    }

    atualizarMomento();

    let batalha_iniciada = false;
    
    function atualizarTurnoUI() {

        const player = document.getElementById("player");
        const oponente = document.getElementById("oponente");

        if (vez == 0) {
            indicar_vez.textContent = "Você";
            cor_vez.forEach(element => {
                element.classList.remove("text-danger");
                element.classList.add("text-success");
            });

            skill01.disabled = !skill01Disponivel;
            skill02.disabled = !skill02Disponivel;
            skill03.disabled = !skill03Disponivel;

            player.style.backgroundImage = "url('')";
            oponente.style.backgroundImage = "url({{ asset('assets/images/gifs/auras/' . strtolower($oponente->classe) . '.gif') }})";

            if (batalha_iniciada == false) {
                atacar.classList.remove("opacity-75");
                atacar.disabled = false;
            } else {
                batalha_iniciada = true;
                
                setTimeout(() => {
                    atacar.classList.remove("opacity-75");
                    atacar.disabled = false;
                }, 3000);
            }
        } else {
            indicar_vez.textContent = "Oponente";
            cor_vez.forEach(element => {
                element.classList.remove("text-success");
                element.classList.add("text-danger");
            });
            atacar.classList.add("opacity-75");
            atacar.disabled = true;

            skill01.disabled = true;
            skill02.disabled = true;
            skill03.disabled = true;

            oponente.style.backgroundImage = "url('')";
            player.style.backgroundImage = "url({{ asset('assets/images/gifs/auras/' . strtolower(Auth::user()->personagem->classe) . '.gif') }})";

            if (batalha_iniciada == false) {
                batalha_iniciada = true;
            }

            setTimeout(() => {
                ataque.click();
            }, 3500);
        }
    }

    atualizarTurnoUI();

    const som_ataque = document.getElementById("som_ataque");

    if (atacar) {
        atacar.addEventListener("click", function() {
            salvar();

            const skillSelecionada = document.querySelector('input[name="btnradio"]:checked');
            const radios = document.querySelectorAll('input[name="btnradio"]');
            const index = Array.from(radios).indexOf(skillSelecionada);

            if (!skillSelecionada) {
                document.getElementById("escolha").hidden = false;

                setTimeout(() => {
                    document.getElementById("escolha").hidden = true;
                }, 3000);

                return;
            }

            fetch("{{ route('atacar') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    btnradio: skillSelecionada.value
                })
            }).then(response => response.json())
            .then(data => {
                if (data.success) {

                    const player = document.getElementById("player");
                    const oponente = document.getElementById("oponente");

                    hp_player = data.hp_player;
                    hp_oponente = data.hp_oponente;

                    player.src = "{{ asset('assets/images/personagens_ataque/' . strtolower(Auth::user()->personagem->classe) . '.png') }}";

                    setTimeout(() => {
                        player.src = "{{ asset('assets/images/personagens/' . strtolower(Auth::user()->personagem->classe) . '.png') }}";
                        oponente.src = "{{ asset('assets/images/personagens/' . strtolower($oponente->classe) . '_reverso.png') }}";
                    }, 3000);

                    if (data.classe == "Mago") {
                        magiaPlayer();
                    }

                    ataquePlayer(index);

                    skillSelecionada.checked = false;

                    som_ataque.currentTime = 0;
                    som_ataque.play().catch(error => {
                        console.error("Erro ao reproduzir o áudio de ataque:", error);
                    });

                    document.getElementById("hp").style.width = calcularPorcentagem(data.hp_player, hp_maximo_player) + "%";
                    document.getElementById("hp_oponente").style.width = calcularPorcentagem(data.hp_oponente, hp_maximo_oponente) + "%";
                    document.getElementById("dano_player").textContent = "🎯 -" + data.dano;
                    document.getElementById("dano_player").hidden = false;

                    setTimeout(() => {
                        document.getElementById("dano_player").hidden = true;
                    }, 3000);

                    if (data.hp_oponente <= 0) {
                        window.location.reload();
                    }

                    skill01Disponivel = data.skill01;
                    skill02Disponivel = data.skill02;
                    skill03Disponivel = data.skill03;

                    vez = data.vez;

                    atualizarTurnoUI();
                    atualizarMomento();
                } else {
                    console.error("Erro ao processar o ataque:", data.message);
                }
            })
            .catch(error => {
                console.error("Erro na requisição de ataque:", error);
            });
        });
    }

    ataque.addEventListener("click", function() {
        salvar();

        fetch("{{ route('ataque', ['id' => $batalha->oponente_id]) }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({})
        }).then(response => response.json())
        .then(data => {
            if (data.success) {                

                const player = document.getElementById("player");
                const oponente = document.getElementById("oponente");

                hp_player = data.hp_player;
                hp_oponente = data.hp_oponente;

                oponente.src = "{{ asset('assets/images/personagens_ataque/' . strtolower($oponente->classe) . '_reverso.png') }}";

                setTimeout(() => {
                    player.src = "{{ asset('assets/images/personagens/' . strtolower(Auth::user()->personagem->classe) . '.png') }}";
                    oponente.src = "{{ asset('assets/images/personagens/' . strtolower($oponente->classe) . '_reverso.png') }}";
                }, 3000);

                if (data.classe == "Mago") {
                    magiaOponente();
                }

                ataqueOponente(data.tipo_ataque);

                som_ataque.currentTime = 0;
                som_ataque.play().catch(error => {
                    console.error("Erro ao reproduzir o áudio de ataque:", error);
                });

                document.getElementById("hp").style.width = calcularPorcentagem(data.hp_player, hp_maximo_player) + "%";
                document.getElementById("hp_oponente").style.width = calcularPorcentagem(data.hp_oponente, hp_maximo_oponente) + "%";
                document.getElementById("dano_oponente").textContent = "🎯 -" + data.dano;
                document.getElementById("dano_oponente").hidden = false;

                setTimeout(() => {
                    document.getElementById("dano_oponente").hidden = true;
                }, 3000);

                if (data.hp_player <= 0) {
                    window.location.reload();
                }

                skill01Disponivel = data.skill01;
                skill02Disponivel = data.skill02;
                skill03Disponivel = data.skill03;

                vez = data.vez;
                
                atualizarTurnoUI();
                atualizarMomento();
            } else {
                console.error("Erro ao processar o ataque do oponente:", data.message);
            }
        })
        .catch(error => {
            console.error("Erro na requisição de ataque do oponente:", error);
        });
    });
</script>