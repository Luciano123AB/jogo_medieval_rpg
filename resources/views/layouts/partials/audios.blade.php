@php

    $musica = "";
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

<audio id="trilha_sonora" loop>
    <source id="source_trilha" src="{{ asset("assets/audios/trilhas_sonoras/$musica") }}" type="audio/mpeg">
</audio>

<audio id="som_ataque" muted>
    <source src="{{ asset("assets/audios/ataque.mp3") }}" type="audio/mpeg">
</audio>

<audio id="som_final" muted>
    <source src="{{ asset("assets/audios/$som_final") }}" type="audio/mpeg">
</audio>

<audio id="click">
    <source src="{{ asset("assets/audios/click.wav") }}" type="audio/wav">
</audio>