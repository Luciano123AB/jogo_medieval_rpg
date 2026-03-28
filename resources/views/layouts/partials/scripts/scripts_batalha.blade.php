@php
    $tempo = Cache::get("batalha_tempo_" . session("id_batalha"), [
        "segundos" => 0,
        "minutos" => 0
    ]);
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
        const centroPlayer = getCentroElemento(player);
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
    const ataque = document.getElementById("ataque");

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

        @if(session()->has("forte_player") || session()->has("ultimate_player"))
            setTimeout(() => {
                salvar();

                ataque.click();
            }, 2000);
        @else
            setTimeout(() => {
                salvar();
                
                ataque.click();
            }, 3000);
        @endif
    @else
        skill01.disabled = false;
        skill02.disabled = false;
        skill03.disabled = false;

        if (atacar) {
            atacar.addEventListener("click", function () {
                salvar();
            });
        }
    @endif

    @if($batalha->skill01 == false)
        skill01.disabled = true;
    @endif

    @if($batalha->skill02 == false)
        skill02.disabled = true;
    @endif

    @if($batalha->skill03 == false)
        skill03.disabled = true;
    @endif

    let distancia_player = [0, 0];
    let distancia_oponente = [0, 0];

    @if(Auth::user()->personagem->classe == "Mago")
        distancia_player = [50, 100];
    @else
        distancia_player = [250, distanciaRealX * 0.8];
    @endif

    @if($oponente->classe == "Mago")
        distancia_oponente = [50, 100];
    @else
        distancia_oponente = [250, distanciaRealX * 0.8];
    @endif

    const hp_player = {{ $batalha->hp }};
    const hp_maximo_player = {{ $batalha->hp_maximo }};

    const hp_oponente = {{ $batalha->hp_oponente }};
    const hp_maximo_oponente = {{ $batalha->hp_maximo_oponente }};

    function calcularPorcentagem(atual, maximo) {
        return (atual / maximo) * 100;
    }

    document.getElementById("hp").style.width = calcularPorcentagem(hp_player, hp_maximo_player) + "%";
    document.getElementById("hp_oponente").style.width = calcularPorcentagem(hp_oponente, hp_maximo_oponente) + "%";

    if (calcularPorcentagem(hp_player, hp_maximo_player) <= 10 || calcularPorcentagem(hp_oponente, hp_maximo_oponente) <= 10) {
        document.getElementById("alerta").textContent = "Momento Decisivo!";
    }
</script>