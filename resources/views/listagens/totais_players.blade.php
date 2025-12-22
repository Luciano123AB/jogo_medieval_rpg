@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="fundos_card_{{ $tema }} card p-3">
            <div class="row row-cols-1 row-cols-md-5 g-4">
                @foreach ($totais as $codigo => $dados)
                    <div class="col animate__animated animate__fadeInTopLeft">
                        <div class="cards sombras card {{ session("tema") == "escuro" ? "bg-secondary border-primary" : "bg-dark border-danger" }} text-center">
                            <div class="d-flex border-3 border-start border-black rounded-top-1">
                                <i class="fi fi-{{ strtolower($codigo) }} animate__animated animate__jello animate__infinite border-start border-end mb-1"></i>
                            </div>
                            <p class="cor_fontes_{{ $tema }}">
                                {{ mb_strtoupper($dados["nome"], "UTF-8") }}:
                                <br>
                                <span class="fs-4">{{ $dados["total"] }}</span>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection