@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="{{ session("tema") == "escuro" ? "fundos_card_claro" : "fundos_card_escuro" }} card p-3">
            <div class="row row-cols-1 row-cols-md-5 g-4">
                @foreach ($totais as $codigo => $dados)
                    <div class="col animate__animated animate__fadeInTopLeft">
                        <div class="cards sombras card {{ session("tema") == "escuro" ? "bg-secondary border-primary" : "bg-dark border-danger" }} text-center">
                            <div class="d-flex border-3 border-start border-black">
                                <i class="fi fi-{{ strtolower($codigo) }} animate__animated animate__jello animate__infinite border border-start-0 border-white"></i>
                            </div>
                            <p class="{{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}">{{ mb_strtoupper($dados["nome"], "UTF-8") }}: {{ $dados["total"] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection