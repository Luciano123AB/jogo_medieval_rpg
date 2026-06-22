@php

    $som_final = "";

    if ($pagina != "Preparação" && $pagina != "Batalhas" && $pagina != "Batalha") {
        $musica = "normal.mp3";
    } else {
        $musica = "batalha.mp3";
    }

    if (session()->has("vitoria")) {
        $som_final = "vitoria.mp3";
    }

    if (session()->has("derrota")) {
        $som_final = "derrota.mp3";
    }
@endphp

<audio id="click">
    <source src="{{ asset("assets/audios/click.wav") }}" type="audio/wav">
</audio>

<audio id="trilha_sonora" loop preload="auto">
    <source id="source_trilha" src="{{ asset("assets/audios/trilhas_sonoras/$musica") }}" type="audio/mpeg">
</audio>

<audio id="som_ataque">
    <source src="{{ asset("assets/audios/ataque.mp3") }}" type="audio/mpeg">
</audio>

<audio id="som_final">
    <source src="{{ asset("assets/audios/$som_final") }}" type="audio/mpeg">
</audio>

<audio id="level_up">
    <source src="{{ asset("assets/audios/level_up.mp3") }}" type="audio/mpeg">
</audio>

<script>
    @if (session()->has("vitoria") || session()->has("derrota"))

        const som_resultado = document.getElementById("som_final");            

        audio.pause();
        som_resultado.currentTime = 0;
        som_resultado.play().catch(() => {});

        setTimeout(() => {
            som_resultado.pause();

            if (trilhaEstavaTocando) {
                audio.play().catch(() => {});
            }
        }, {{ session()->has("vitoria") ? 4300 : 1500 }});
    @endif

    @if (session()->has("level_up"))

        const som_level = document.getElementById("level_up");

        audio.pause();
        som_level.currentTime = 0;
        som_level.play().catch(() => {});

        setTimeout(() => {
            som_level.pause();

            if (trilhaEstavaTocando) {
                audio.play().catch(() => {});
            }
        }, 2000);
    @endif
</script>
<script src="{{ asset('assets/js/tocar_sons.js') }}"></script>