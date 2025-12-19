@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="{{ session("tema") == "escuro" ? "fundos_card_claro" : "fundos_card_escuro" }} card p-3">
            <div class="row row-cols-1 row-cols-md-2 g-3">
                <div class="col cards">
                    <div class="sombras tabelas card animate__animated animate__backInLeft {{ session("tema") == "escuro" ? "bg-secondary border-primary" : "bg-dark border-danger" }} p-3">
                        <div class="d-flex justify-content-between mb-2">
                            <h4 class="{{ session("tema") == "escuro" ? "cor_fontes_escuro titulos_escuro" : "cor_fontes_claro titulos_claro" }}">-Vitórias:</h4>
                            <div></div>
                            <a href="{{ route("resetarVitorias") }}" type="button" class="cursor sombras botoes btn {{ session("tema") == "escuro" ? "btn-light border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }}">
                                <span class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }} d-flex justify-content-center">
                                    <div class="cursor animate__animated animate__flipOutY animate__infinite">
                                        <i class="cursor bi bi-x-circle-fill me-1"></i>
                                    </div>
                                    Resetar
                                </span>
                            </a>
                        </div>
                        <div class="tabelas-scroll">
                            <table class="border border-2 {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} w-100">
                                <thead class="text-center">
                                    <th class="{{ session("tema") == "escuro" ? "titulos_escuro cor_fontes_escuro border-primary" : "titulos_claro cor_fontes_claro border-danger" }} border px-1">
                                        <i class="bi bi-list-ol"></i>
                                        Nº
                                    </th>
                                    <th class="{{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} border">👑</th>
                                    <th class="{{ session("tema") == "escuro" ? "titulos_escuro cor_fontes_escuro border-primary" : "titulos_claro cor_fontes_claro border-danger" }} border">Você</th>
                                    <th class="{{ session("tema") == "escuro" ? "titulos_escuro cor_fontes_escuro border-primary" : "titulos_claro cor_fontes_claro border-danger" }} border px-1">VS</th>
                                    <th class="{{ session("tema") == "escuro" ? "titulos_escuro cor_fontes_escuro border-primary" : "titulos_claro cor_fontes_claro border-danger" }} border">Oponente</th>
                                    <th class="{{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} border">⚰️</th>
                                </thead>

                                <tbody>
                                    @forelse ($batalhas_vitorias as $vitorias)
                                        <tr>
                                            <td class="{{ session("tema") == "escuro" ? "cor_fontes_escuro border-primary" : "cor_fontes_claro border-danger" }} border text-center fw-bold">{{ $loop->index + 1 }}</td>
                                            <td class="{{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} border text-success text-center fw-bold px-1">VITÓRIA</td>
                                            <td class="{{ session("tema") == "escuro" ? "cor_fontes_escuro border-primary" : "cor_fontes_claro border-danger" }} border text-center px-1">{{ $vitorias->ganhou }}</td>
                                            <td class="{{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} border text-center">🆚</td>
                                            <td class="{{ session("tema") == "escuro" ? "cor_fontes_escuro border-primary" : "cor_fontes_claro border-danger" }} border text-center px-1">{{ $vitorias->perdeu }}</td>
                                            <td class="{{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} border text-danger text-center fw-bold px-1">DERROTA</td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="6" class="{{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}">NENHUMA VITÓRIA EXISTENTE AINDA</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col cards">
                    <div class="sombras tabelas card animate__animated animate__backInRight {{ session("tema") == "escuro" ? "bg-secondary border-primary" : "bg-dark border-danger" }} p-3">
                        <div class="d-flex justify-content-between mb-2">
                            <h4 class="{{ session("tema") == "escuro" ? "cor_fontes_escuro titulos_escuro" : "cor_fontes_claro titulos_claro" }}">-Derrotas:</h4>
                            <div></div>
                            <a href="{{ route("resetarDerrotas") }}" type="button" class="cursor sombras botoes btn {{ session("tema") == "escuro" ? "btn-light border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }}">
                                <span class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }} d-flex justify-content-center">
                                    <div class="cursor animate__animated animate__flipOutY animate__infinite">
                                        <i class="cursor bi bi-x-circle-fill me-1"></i>
                                    </div>
                                    Resetar
                                </span>
                            </a>
                        </div>
                        <div class="tabelas-scroll">
                            <table class="border border-2 {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} w-100">
                                <thead class="text-center">
                                    <th class="{{ session("tema") == "escuro" ? "titulos_escuro cor_fontes_escuro border-primary" : "titulos_claro cor_fontes_claro border-danger" }} border px-1">
                                        <i class="bi bi-list-ol"></i>
                                        Nº
                                    </th>
                                    <th class="{{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} border">⚰️</th>
                                    <th class="{{ session("tema") == "escuro" ? "titulos_escuro cor_fontes_escuro border-primary" : "titulos_claro cor_fontes_claro border-danger" }} border">Você</th>
                                    <th class="{{ session("tema") == "escuro" ? "titulos_escuro cor_fontes_escuro border-primary" : "titulos_claro cor_fontes_claro border-danger" }} border px-1">VS</th>
                                    <th class="{{ session("tema") == "escuro" ? "titulos_escuro cor_fontes_escuro border-primary" : "titulos_claro cor_fontes_claro border-danger" }} border">Oponente</th>
                                    <th class="{{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} border">👑</th>
                                </thead>

                                <tbody>
                                    @forelse ($batalhas_derrotas as $derrotas)
                                        <tr>
                                            <td class="{{ session("tema") == "escuro" ? "cor_fontes_escuro border-primary" : "cor_fontes_claro border-danger" }} border text-center fw-bold">{{ $loop->index + 1 }}</td>
                                            <td class="{{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} border text-danger text-center fw-bold px-1">DERROTA</td>
                                            <td class="{{ session("tema") == "escuro" ? "cor_fontes_escuro border-primary" : "cor_fontes_claro border-danger" }} border text-center px-1">{{ $derrotas->perdeu }}</td>
                                            <td class="{{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} border text-center">🆚</td>
                                            <td class="{{ session("tema") == "escuro" ? "cor_fontes_escuro border-primary" : "cor_fontes_claro border-danger" }} border text-center px-1">{{ $derrotas->ganhou }}</td>
                                            <td class="{{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} border text-success text-center fw-bold px-1">VITÓRIA</td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="6" class="{{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}">NENHUMA DERROTA EXISTENTE AINDA</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection