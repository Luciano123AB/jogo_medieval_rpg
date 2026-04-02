@php

    $temas = ["secondary", "primary", "brightness-high", "escuro"];
    
    if (session("tema") == "claro" || !session()->has("tema")) {
        $temas = ["dark", "danger", "moon-stars", "claro"];
    }
@endphp

<div class="animate__animated animate__fadeInDown d-flex justify-content-between mb-5">
    <button id="botao_musica" class="cursor sombras botoes subnavbar btn focus-ring btn-{{ $temas[0] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} border rounded-circle mx-3">
        <i id="icone_musica" class="cursor cor_fontes_{{ $temas[3] }} bi bi-volume-up-fill fs-4"></i>
    </button>

    <div class="horizontal_vertical gap-3">
        @if(Auth::user() && $pagina != "Batalhas" && $pagina != "Batalha")
            <a href="{{ route("batalhas") }}" class="cursor sombras botoes animate__animated animate__fadeIn btn btn-lg focus-ring btn-{{ $temas[0] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} border">
                <span class="cursor cor_fontes_{{ $temas[3] }} d-flex">
                    <div class="cursor animate__animated animate__swing animate__infinite">
                        <i class="cursor bi bi-card-list me-2"></i>
                    </div>
                    Batalhas em Andamento
                </span>
            </a>
        @endif
    
        @if(Auth::user() && $pagina != "Totais" && $pagina != "Batalha")
            <a href="{{ route("totais") }}" class="cursor sombras botoes animate__animated animate__fadeIn btn btn-lg focus-ring btn-{{ $temas[0] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} border">
                <span class="cursor cor_fontes_{{ $temas[3] }} d-flex">
                    <div class="cursor animate__animated animate__wobble animate__infinite">
                        <i class="cursor bi bi-flag-fill me-2"></i>
                    </div>
                    Total de Players(Países)
                </span>
            </a>
        @endif

        @if ($pagina == "Batalha")
            <button id="tela_cheia" class="cursor sombras botoes btn focus-ring btn-{{ $temas[0] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} border rounded-circle">
                <i id="icone_tela" class="cursor cor_fontes_{{ $temas[3] }} bi bi-arrows-angle-expand fs-4"></i>
            </button>
        @endif
    </div>

    <a href="{{ route("tema") }}" class="cursor sombras botoes subnavbar btn focus-ring btn-{{ $temas[0] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} border rounded-circle mx-3">
        <i class="cursor cor_fontes_{{ $temas[3] }} bi-{{ $temas[2] }}-fill bi fs-4"></i>
    </a>
</div>

@include("layouts.partials.audios")
@include("layouts.partials.scripts.tocar_sons")