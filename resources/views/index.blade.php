@extends("layouts.main_layout")

@section("content")
    <div id="espacamento" class="container text-center">
        <div class="fundos_card_{{ $tema }} card w-75 mx-auto p-3">
            <div class="animate__animated animate__zoomInDown d-grid gap-3">
                <a href="{{ route("preparacao") }}" class="cursor sombras botoes btn btn-lg {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} border border-3">
                    <span class="cursor cor_fontes_{{ $tema }} d-flex justify-content-center">
                        <div class="cursor animate__animated animate__headShake animate__infinite">
                            <i class="cursor me-2">⚔️</i>
                        </div>
                        Batalhar!
                    </span>
                </a>
                <a href="{{ route("regras") }}" class="cursor sombras botoes btn btn-lg {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} border border-3">
                    <span class="cursor cor_fontes_{{ $tema }} d-flex justify-content-center">
                        <div class="cursor animate__animated animate__flipOutY animate__infinite">
                            <i class="cursor bi bi-question-circle-fill me-2"></i>
                        </div>
                        Como Jogar?/Regras
                    </span>
                </a>
                <a href="{{ route("sobre") }}" class="cursor sombras botoes btn btn-lg {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} border border-3">
                    <span class="cursor cor_fontes_{{ $tema }} d-flex justify-content-center">
                        <div class="cursor animate__animated animate__flipInX animate__infinite">
                            <i class="cursor bi bi-person-lines-fill me-2"></i>
                        </div>
                        Sobre as Classes
                    </span>
                </a>
                <a href="{{ route("creditos") }}" class="cursor sombras botoes btn btn-lg {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} border border-3">
                    <span class="cursor cor_fontes_{{ $tema }} d-flex justify-content-center">
                        <div class="cursor animate__animated animate__flipInX animate__infinite">
                            <i class="cursor bi bi-body-text me-2"></i>
                        </div>
                        Créditos
                    </span>
                </a>
            </div>
        </div>
    </div>
@endsection