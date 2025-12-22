@include("layouts.partials.audios")

<div class="animate__animated animate__fadeInDown d-flex justify-content-between mb-5">
    <button id="botao_musica" class="cursor sombras botoes subnavbar btn {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} border rounded-circle mx-3">
        <i id="icone_musica" class="cursor cor_fontes_{{ $tema }} bi bi-volume-up-fill fs-4"></i>
    </button>

    <div class="d-flex gap-3 flex-column flex-md-row">
        @if(session()->has("player") && $pagina != "Batalhas" && $pagina != "Batalha")
            <a href="{{ route("batalhas") }}" class="cursor sombras botoes animate__animated animate__fadeIn btn btn-lg {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} border">
                <span class="cursor cor_fontes_{{ $tema }} d-flex">
                    <div class="cursor animate__animated animate__swing animate__infinite">
                        <i class="cursor bi bi-card-list me-2"></i>
                    </div>
                    Batalhas em Andamento
                </span>
            </a>
        @endif
    
        @if(session()->has("player") && $pagina != "Totais" && $pagina != "Batalha")
            <a href="{{ route("totais") }}" class="cursor sombras botoes animate__animated animate__fadeIn btn btn-lg {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} border">
                <span class="cursor cor_fontes_{{ $tema }} d-flex">
                    <div class="cursor animate__animated animate__wobble animate__infinite">
                        <i class="cursor bi bi-flag-fill me-2"></i>
                    </div>
                    Total de Players(Países)
                </span>
            </a>
        @endif
    </div>

    <a href="{{ route("tema") }}" class="cursor sombras botoes subnavbar btn {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} border rounded-circle mx-3">
        <i class="cursor cor_fontes_{{ $tema }} {{ session("tema") == "escuro" ? "bi-brightness-high-fill" : "bi-moon-stars-fill" }} bi fs-4"></i>
    </a>
</div>