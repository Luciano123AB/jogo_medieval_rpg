@extends("layouts.main_layout")

@section("content")
    @include("layouts.partials.styles.estilos_tabelas")

    <div class="container">
        <div class="fundos_card_{{ $temas[3] }} card p-3">
            <div class="horizontal_vertical gap-3">
                <div class="sombras tabelas registro card bg-{{ $temas[0] }} border-{{ $temas[1] }} p-3">
                    <div class="d-flex justify-content-between mb-2">
                        <h4 class="cor_fontes_{{ $temas[3] }} titulos_{{ $temas[3] }}">-Vitórias:</h4>
                        <div></div>
                        <form action="{{ route("resetarVitorias") }}" method="POST">
                            @csrf
                            @method("DELETE")

                            <button type="submit" class="cursor sombras botoes btn focus-ring btn-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }}">
                                <span class="cursor cor_fontes_{{ $temas[3] }} d-flex justify-content-center">
                                    <div class="cursor animate__animated animate__bounceOut animate__infinite">
                                        <i class="cursor bi bi-x-circle-fill me-1"></i>
                                    </div>
                                    Resetar
                                </span>
                            </button>
                        </form>
                    </div>
                    <div class="tabelas-scroll">
                        <table id="tabela" class="border border-2 border-{{ $temas[1] }} w-100">
                            <thead class="text-center">
                                <tr>
                                    <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center px-1">
                                        <i class="bi bi-list-ol titulos_colunas"></i>Nº
                                    </th>
                                    <th class="border-{{ $temas[1] }} border text-center px-1">👑</th>
                                    <th class="border-{{ $temas[1] }} border text-center px-1">
                                        <i class="titulos_colunas">🤜🏻</i>
                                        <span class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }}">Você</span>
                                    </th>
                                    <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center px-1">VS</th>
                                    <th class="border-{{ $temas[1] }} border text-center px-1">
                                        <i class="titulos_colunas">🤛🏻</i>
                                        <span class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }}">Oponente</span>
                                    </th>
                                    <th class="border-{{ $temas[1] }} border text-center px-1">⚰️</th>
                                    <th class="border-{{ $temas[1] }} border text-center px-1"><i class="cor_fontes_{{ $temas[3] }} bi bi-x-circle-fill"></i></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($batalhas_vitorias as $vitorias)
                                    <tr>
                                        <td class="cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center fw-bold">{{ $loop->index + 1 }}</td>
                                        <td class="border-{{ $temas[1] }} border text-success text-center fw-bold px-1">VITÓRIA</td>
                                        <td class="cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center px-1">{{ $vitorias->ganhou }}</td>
                                        <td class="border-{{ $temas[1] }} border text-center">🆚</td>
                                        <td class="cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center px-1">{{ $vitorias->perdeu }}</td>
                                        <td class="border-{{ $temas[1] }} border text-danger text-center fw-bold px-1">DERROTA</td>
                                        <td class="border-{{ $temas[1] }} border text-danger text-center fw-bold p-1">
                                            <form action="{{ route("excluir", ["id" => $vitorias->id_crypt]) }}" method="POST">
                                                @csrf
                                                @method("DELETE")

                                                <button type="submit" class="cursor sombras botoes btn btn-sm focus-ring btn-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }}">
                                                    <span class="cursor cor_fontes_{{ $temas[3] }}">
                                                        <div class="cursor animate__animated animate__bounceOut animate__infinite">
                                                            <i class="cursor bi bi-trash-fill"></i>
                                                        </div>
                                                    </span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="sombras tabelas registro card bg-{{ $temas[0] }} border-{{ $temas[1] }} p-3">
                    <div class="d-flex justify-content-between mb-2">
                        <h4 class="cor_fontes_{{ $temas[3] }} titulos_{{ $temas[3] }}">-Derrotas:</h4>
                        <div></div>
                        <form action="{{ route("resetarDerrotas") }}" method="POST">
                            @csrf
                            @method("DELETE")

                            <button type="submit" class="cursor sombras botoes btn focus-ring btn-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }}">
                                <span class="cursor cor_fontes_{{ $temas[3] }} d-flex justify-content-center">
                                    <div class="cursor animate__animated animate__bounceOut animate__infinite">
                                        <i class="cursor bi bi-x-circle-fill me-1"></i>
                                    </div>
                                    Resetar
                                </span>
                            </button>
                        </form>
                    </div>
                    <div class="tabelas-scroll">
                        <table id="tabela02" class="border border-2 border-{{ $temas[1] }} w-100">
                            <thead class="text-center">
                                <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center px-1">
                                    <i class="bi bi-list-ol titulos_colunas"></i>Nº
                                </th>
                                <th class="border-{{ $temas[1] }} border text-center px-1">⚰️</th>
                                <th class="border-{{ $temas[1] }} border text-center px-1">
                                    <i class="titulos_colunas">🤜🏻</i>
                                    <span class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }}">Você</span>
                                </th>
                                <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center px-1">VS</th>
                                <th class="border-{{ $temas[1] }} border text-center px-1">
                                    <i class="titulos_colunas">🤛🏻</i>
                                    <span class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }}">Oponente</span>
                                </th>
                                <th class="border-{{ $temas[1] }} border text-center px-1">👑</th>
                                <th class="border-{{ $temas[1] }} border text-center px-1"><i class="cor_fontes_{{ $temas[3] }} bi bi-x-circle-fill"></i></th>
                            </thead>

                            <tbody>
                                @foreach ($batalhas_derrotas as $derrotas)
                                    <tr>
                                        <td class="cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center fw-bold">{{ $loop->index + 1 }}</td>
                                        <td class="border-{{ $temas[1] }} border text-danger text-center fw-bold px-1">DERROTA</td>
                                        <td class="cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center px-1">{{ $derrotas->perdeu }}</td>
                                        <td class="border-{{ $temas[1] }} border text-center">🆚</td>
                                        <td class="cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center px-1">{{ $derrotas->ganhou }}</td>
                                        <td class="border-{{ $temas[1] }} border text-success text-center fw-bold px-1">VITÓRIA</td>
                                        <td class="border-{{ $temas[1] }} border text-danger text-center fw-bold p-1">
                                            <form action="{{ route("excluir", ["id" => $derrotas->id_crypt]) }}" method="POST">
                                                @csrf
                                                @method("DELETE")

                                                <button type="submit" class="cursor sombras botoes btn btn-sm focus-ring btn-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }}">
                                                    <span class="cursor cor_fontes_{{ $temas[3] }}">
                                                        <div class="cursor animate__animated animate__bounceOut animate__infinite">
                                                            <i class="cursor bi bi-trash-fill"></i>
                                                        </div>
                                                    </span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include("layouts.partials.scripts.tabelas")
@endsection