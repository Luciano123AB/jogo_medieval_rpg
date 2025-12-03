@extends("layouts.main_layout")

@section("content")
    <div id="espacamento" class="container text-center">
        <div class="{{ session("tema") == "escuro" ? "fundos_card_claro" : "fundos_card_escuro" }} card w-75 mx-auto p-3">
            <div class="animate__animated animate__zoomInDown d-grid gap-3">
                <a href="{{ route("preparacao") }}" class="cursor sombras botoes btn btn-lg {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} border border-3"><span class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}">⚔️ Batalhar!</span></a>
                <a href="{{ route("regras") }}" class="cursor sombras botoes btn btn-lg {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} border border-3"><span class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}"><i class="cursor bi bi-question-circle-fill"></i> Como Jogar?/Regras</span></a>
                <a href="{{ route("sobre") }}" class="cursor sombras botoes btn btn-lg {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} border border-3"><span class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}"><i class="cursor bi bi-person-lines-fill"></i> Sobre as Classes</span></a>
                <a href="{{ route("creditos") }}" class="cursor sombras botoes btn btn-lg {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} border border-3"><span class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}"><i class="cursor bi bi-body-text"></i> Créditos</span></a>
            </div>
        </div>
    </div>
@endsection