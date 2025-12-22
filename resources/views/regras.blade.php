@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="fundos_card_{{ session("tema") }} card p-3">
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach ($regras as $regra)
                    <div class="col animate__animated {{ $regra->animacao01 }}">
                        <div class="cards sombras card {{ session("tema") == "escuro" ? "bg-secondary border-primary" : "bg-dark border-danger" }}">
                            <img src="{{ asset("assets/images/regras/" . (session("tema") == "escuro" ? "$regra->imagem.png" : "$regra->imagem" . "_noite.png")) }}" class="card-img-top border-bottom {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }}">
                            <div class="card-body">
                                <h4 class="card-title d-flex">
                                    <div class="animate__animated {{ $regra->animacao02 }} animate__infinite">
                                        <i class="bi {{ $regra->icone }} titulos_{{ session("tema") }} cor_fontes_{{ session("tema") }} me-2"></i>
                                    </div>
                                    <span class="titulos_{{ session("tema") }} cor_fontes_{{ session("tema") }}">{{ $regra->regra }}:</span>
                                </h4>
                                <p class="paragrafos cor_fontes_{{ session("tema") }} card-text">{{ $regra->explicacao }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>            
        </div>
    </div>
@endsection