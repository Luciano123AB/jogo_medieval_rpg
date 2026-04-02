@extends("layouts.main_layout")

@section("content")
    <div class="container text-center">
        <div id="home_opcoes" class="fundos_card_{{ $temas[2] }} card mx-auto p-3">
            <div class="perspectiva animate__animated animate__zoomInDown d-grid gap-3">
                <a href="{{ route("preparacao") }}" class="cursor rotacao_direita sombras botoes btn btn-lg focus-ring btn-{{ $temas[0] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} border border-3">
                    <span class="cursor cor_fontes_{{ $temas[2] }} d-flex justify-content-center">
                        <div class="cursor animate__animated animate__headShake animate__infinite">
                            <i class="cursor me-2">⚔️</i>
                        </div>
                        Batalhar!
                    </span>
                </a>
                <a href="{{ route("regras") }}" class="cursor rotacao_esquerda sombras botoes btn btn-lg focus-ring btn-{{ $temas[0] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} border border-3">
                    <span class="cursor cor_fontes_{{ $temas[2] }} d-flex justify-content-center">
                        <div class="cursor animate__animated animate__flipOutY animate__infinite">
                            <i class="cursor bi bi-question-circle-fill me-2"></i>
                        </div>
                        Como Jogar?/Regras
                    </span>
                </a>
                <a href="{{ route("sobre") }}" class="cursor rotacao_direita sombras botoes btn btn-lg focus-ring btn-{{ $temas[0] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} border border-3">
                    <span class="cursor cor_fontes_{{ $temas[2] }} d-flex justify-content-center">
                        <div class="cursor animate__animated animate__flipInX animate__infinite">
                            <i class="cursor bi bi-person-lines-fill me-2"></i>
                        </div>
                        Sobre as Classes
                    </span>
                </a>
                <a href="{{ route("creditos") }}" class="cursor rotacao_esquerda sombras botoes btn btn-lg focus-ring btn-{{ $temas[0] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} border border-3">
                    <span class="cursor cor_fontes_{{ $temas[2] }} d-flex justify-content-center">
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