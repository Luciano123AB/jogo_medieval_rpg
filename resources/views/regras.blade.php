@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="fundos_card_{{ $temas[2] }} card p-3">
            <div class="row row-cols-1 row-cols-md-2 d-flex justify-content-center g-3">
                @foreach ($regras as $regra)
                    <div class="col animate__animated {{ $regra->animacao01 }}">
                        <div class="cards sombras card bg-{{ $temas[0] }} border-{{ $temas[1] }} h-100">
                            <div class="horizontal_vertical h-100">
                                <img src="{{ asset("assets/images/regras/" . ($temas[2] == "escuro" ? "$regra->imagem.png" : "$regra->imagem" . "_noite.png")) }}" id="regras" class="border-{{ $temas[1] }}">
                                <div class="card-body">
                                    <h4 class="card-title d-flex">
                                        <div class="animate__animated {{ $regra->animacao02 }} animate__infinite">
                                            <i class="bi {{ $regra->icone }} titulos_{{ $temas[2] }} cor_fontes_{{ $temas[2] }} me-2"></i>
                                        </div>
                                        <span class="titulos_{{ $temas[2] }} cor_fontes_{{ $temas[2] }}">{{ $regra->regra }}:</span>
                                    </h4>
                                    <p class="paragrafos cor_fontes_{{ $temas[2] }} card-text">{{ $regra->explicacao }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>            
        </div>
    </div>
@endsection