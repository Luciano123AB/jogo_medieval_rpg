@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="fundos_card_{{ $temas[3] }} card p-3">
            <div class="horizontal_vertical gap-3">
                <div class="col">
                    <div class="sombras tabelas card animate__animated animate__backInLeft bg-{{ $temas[0] }} border-{{ $temas[1] }} p-3">
                        <div class="d-flex justify-content-between mb-2">
                            <h4 class="cor_fontes_{{ $temas[3] }} titulos_{{ $temas[3] }}">-Vitórias:</h4>
                            <div></div>
                            <a href="{{ route("resetarVitorias") }}" type="button" class="cursor sombras botoes btn focus-ring btn-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }}">
                                <span class="cursor cor_fontes_{{ $temas[3] }} d-flex justify-content-center">
                                    <div class="cursor animate__animated animate__bounceOut animate__infinite">
                                        <i class="cursor bi bi-x-circle-fill me-1"></i>
                                    </div>
                                    Resetar
                                </span>
                            </a>
                        </div>
                        <div class="tabelas-scroll">
                            <table class="border border-2 border-{{ $temas[1] }} w-100">
                                <thead class="text-center">
                                    <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border px-1">
                                        <i class="bi bi-list-ol"></i>
                                        Nº
                                    </th>
                                    <th class="border-{{ $temas[1] }} border">👑</th>
                                    <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border">Você</th>
                                    <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border px-1">VS</th>
                                    <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border">Oponente</th>
                                    <th class="border-{{ $temas[1] }} border">⚰️</th>
                                </thead>

                                <tbody>
                                    @forelse ($batalhas_vitorias as $vitorias)
                                        <tr>
                                            <td class="cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center fw-bold">{{ $loop->index + 1 }}</td>
                                            <td class="border-{{ $temas[1] }} border text-success text-center fw-bold px-1">VITÓRIA</td>
                                            <td class="cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center px-1">{{ $vitorias->ganhou }}</td>
                                            <td class="border-{{ $temas[1] }} border text-center">🆚</td>
                                            <td class="cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center px-1">{{ $vitorias->perdeu }}</td>
                                            <td class="border-{{ $temas[1] }} border text-danger text-center fw-bold px-1">DERROTA</td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="6" class="cor_fontes_{{ $temas[3] }}">NENHUMA VITÓRIA EXISTENTE AINDA</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="sombras tabelas card animate__animated animate__backInRight bg-{{ $temas[0] }} border-{{ $temas[1] }} p-3">
                        <div class="d-flex justify-content-between mb-2">
                            <h4 class="cor_fontes_{{ $temas[3] }} titulos_{{ $temas[3] }}">-Derrotas:</h4>
                            <div></div>
                            <a href="{{ route("resetarDerrotas") }}" type="button" class="cursor sombras botoes btn focus-ring btn-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }}">
                                <span class="cursor cor_fontes_{{ $temas[3] }} d-flex justify-content-center">
                                    <div class="cursor animate__animated animate__bounceOut animate__infinite">
                                        <i class="cursor bi bi-x-circle-fill me-1"></i>
                                    </div>
                                    Resetar
                                </span>
                            </a>
                        </div>
                        <div class="tabelas-scroll">
                            <table class="border border-2 border-{{ $temas[1] }} w-100">
                                <thead class="text-center">
                                    <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border px-1">
                                        <i class="bi bi-list-ol"></i>
                                        Nº
                                    </th>
                                    <th class="border-{{ $temas[1] }} border">⚰️</th>
                                    <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border">Você</th>
                                    <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border px-1">VS</th>
                                    <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border">Oponente</th>
                                    <th class="border-{{ $temas[1] }} border">👑</th>
                                </thead>

                                <tbody>
                                    @forelse ($batalhas_derrotas as $derrotas)
                                        <tr>
                                            <td class="cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center fw-bold">{{ $loop->index + 1 }}</td>
                                            <td class="border-{{ $temas[1] }} border text-danger text-center fw-bold px-1">DERROTA</td>
                                            <td class="cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center px-1">{{ $derrotas->perdeu }}</td>
                                            <td class="border-{{ $temas[1] }} border text-center">🆚</td>
                                            <td class="cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center px-1">{{ $derrotas->ganhou }}</td>
                                            <td class="border-{{ $temas[1] }} border text-success text-center fw-bold px-1">VITÓRIA</td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="6" class="cor_fontes_{{ $temas[3] }}">NENHUMA DERROTA EXISTENTE AINDA</td>
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