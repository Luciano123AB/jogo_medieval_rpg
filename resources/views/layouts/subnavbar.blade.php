@php

    $musica = "";

    if ($pagina != "Preparação" && $pagina != "Batalha") {

        $musica = "trilha_sonora_normal.mp3";

    } else {

        $musica = "trilha_sonora_batalha.mp3";

    }
@endphp

<audio id="trilha_sonora" autoplay muted loop>
    <source src="{{ asset("assets/audios/$musica") }}" type="audio/mpeg">
</audio>

<div class="animate__animated animate__fadeInDown d-flex justify-content-between mb-5">
    <a href="{{ route("musica") }}" class="cursor sombras botoes btn {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} border rounded-circle ms-3 px-3 py-2">
        <i class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }} bi {{ session("musica") == "Desativado" ? "bi-volume-mute-fill" : "bi-volume-up-fill" }} fs-4"></i>
    </a>

    @if($pagina != "Batalhas")
        <a href="{{ route("batalhas") }}" class="cursor sombras botoes animate__animated animate__fadeIn btn btn-lg {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} border">
            <span class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }} align-middle"><i class="bi bi-list-stars"></i> Batalhas em Andamento</span>
        </a>
    @endif

    <a href="{{ route("tema") }}" class="cursor sombras botoes btn {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} border rounded-circle me-3 px-3 py-2">
        <i class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro bi-brightness-high-fill" : "cor_fontes_claro bi-moon-stars-fill" }} bi fs-4"></i>
    </a>
</div>