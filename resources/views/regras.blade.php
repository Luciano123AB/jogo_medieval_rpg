@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="{{ session("tema") == "escuro" ? "fundos_card_claro" : "fundos_card_escuro" }} card p-3">
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach ($regras as $regra)
                    <div class="col animate__animated {{ $regra->animacao }}">
                        <div class="cards sombras card {{ session("tema") == "escuro" ? "bg-secondary border-primary" : "bg-dark border-danger" }}">
                            <img src="{{ asset("assets/images/regras/" . (session("tema") == "escuro" ? "$regra->imagem.png" : "$regra->imagem" . "_noite.png")) }}" class="card-img-top border-bottom {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }}">
                            <div class="card-body">
                                <h4 class="{{ session("tema") == "escuro" ? "titulos_escuro cor_fontes_escuro" : "titulos_claro cor_fontes_claro" }} card-title">
                                    <i class="bi {{ $regra->icone }} me-1"></i>
                                    {{ $regra->regra }}:
                                </h4>
                                <p class="paragrafos {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }} card-text">{{ $regra->explicacao }}</p>
                            </div>
                        </div>
                    </div>                    
                @endforeach
            </div>            
        </div>
    </div>
@endsection