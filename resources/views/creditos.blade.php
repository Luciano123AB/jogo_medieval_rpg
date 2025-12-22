@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="fundos_card_{{ $tema }} card p-3">
            <div class="d-grid gap-3 w-100">
                <div class="sombras card {{ session("tema") == "escuro" ? "bg-secondary border-primary" : "bg-dark border-danger" }} p-3">
                    <div>
                        <h3 class="titulos_{{ $tema }} cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">
                            <i class="bi bi-arrow-right"></i>
                            Nome do jogo e introdução inicial:
                        </h3>
                        <ul>
                            <li class="cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">
                                <img src="{{ asset("assets/images/icones/icone.png") }}" id="icone_creditos">
                                Jogo: Medieval RPG
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="titulos_{{ $tema }} cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">
                            <i class="bi bi-arrow-right"></i>
                            Equipe principal do desenvolvimento:
                        </h3>
                        <ul>
                            <li class="cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">Direção: Luciano Eduardo Stefanello da Silva</li>
                            <li class="cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">Design: Luciano Eduardo Stefanello da Silva</li>
                            <li class="cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">Arte: Luciano Eduardo Stefanello da Silva</li>
                            <li class="cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">Som: Luciano Eduardo Stefanello da Silva</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="titulos_{{ $tema }} cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">
                            <i class="bi bi-arrow-right"></i>
                            Equipe de produtores e líderes:
                        </h3>
                        <ul>
                            <li class="cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">Luciano Eduardo Stefanello da Silva</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="titulos_{{ $tema }} cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">
                            <i class="bi bi-arrow-right"></i>
                            Equipe de apoio e colaboradores:
                        </h3>
                        <ul>
                            <li class="cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">Testadores: Luciano Eduardo Stefanello da Silva</li>
                            <li class="cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">Animadores: Luciano Eduardo Stefanello da Silva</li>
                            <li class="cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">Designers adicionais: Nenhum</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="titulos_{{ $tema }} cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">
                            <i class="bi bi-arrow-right"></i>
                            Música e áudio:
                        </h3>
                        <ul>
                            <li class="cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">Compositores: Nenhum</li>
                            <li class="cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">Dubladores: Nenhum</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="titulos_{{ $tema }} cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">
                            <i class="bi bi-arrow-right"></i>
                            Suporte técnico e colaboradores externos:
                        </h3>
                        <ul>
                            <li class="cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">Luciano Eduardo Stefanello da Silva</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="titulos_{{ $tema }} cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">
                            <i class="bi bi-arrow-right"></i>
                            Agradecimentos especiais:
                        </h3>
                        <ul>
                            <li class="cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">Pessoas: Nenhum</li>
                            <li class="cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">Comunidades: Nenhum</li>
                            <li class="cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">Parceiros: Nenhum</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="titulos_{{ $tema }} cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">
                            <i class="bi bi-arrow-right"></i>
                            <i class="bi bi-arrow-right"></i>
                            Lista das empresas e estúdios envolvidos:
                        </h3>
                        <ul>
                            <li class="cor_fontes_{{ $tema }} animate__animated animate__fadeInUpBig">Nenhum</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection