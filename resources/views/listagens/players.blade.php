@extends("layouts.main_layout")

@section("content")
    @if ($temas[1] == "primary")
        <style>
            .dt-container {
                color: #493722;
            }
        </style>
    @else
        <style>
            .dt-container {
                color: #e5a350;
            }
        </style>
    @endif
    @vite('resources/css/tabelas.css')

    <div class="container">
        <div class="fundos_card_{{ $temas[3] }} card p-3">
            <div class="d-grid gap-3 w-100">
                <div class="d-flex gap-3">
                    <div class="cards w-50">
                        <div class="sombras card animate__animated animate__fadeInLeft bg-{{ $temas[0] }} border-{{ $temas[1] }} p-3">
                            <div class="d-grid text-center">
                                <div class="d-flex justify-content-center mb-2">
                                    <span class="animate__animated animate__tada animate__infinite fs-4 me-1">🏆</span>
                                    <h4 class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }}">Player com Mais Vitórias</h4>
                                </div>
                                <label class="cor_fontes_{{ $temas[3] }}">
                                    @php
                                    
                                        $perfil = asset("assets/images/perfils/" . strtolower($player_lider_vitorias->personagem->classe) . ".png");

                                        if ($player_lider_vitorias->foto != "photos/vazio.png") {
                                            $perfil = asset($player_lider_vitorias->foto);
                                        }
                                    @endphp
                                    <div class="d-flex flex-wrap justify-content-center">
                                        Usuário:
                                        <img src="{{ $perfil }}" class="sombras perfil_players border border-{{ $temas[1] }} rounded-circle ms-1 me-2">
                                        <div class="bandeiras d-flex border-3 border-start border-black rounded-top-1">
                                            <i class="fi fi-{{ strtolower($player_lider_vitorias->pais) }} animate__animated animate__jello animate__infinite border-start border-end mb-1 me-1"></i>
                                        </div>
                                        {{ $player_lider_vitorias->user }}
                                    </div>
                                </label>
                                <label class="cor_fontes_{{ $temas[3] }}">Qtd/Vitórias: {{ $player_lider_vitorias->quantidade_vitorias }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="cards w-50">
                        <div class="sombras d-flex card animate__animated animate__fadeInRight bg-{{ $temas[0] }} border-{{ $temas[1] }} p-3">
                            <div class="d-grid text-center">
                                <div class="d-flex justify-content-center mb-2">
                                    <span class="animate__animated animate__tada animate__infinite fs-4 me-1">🏆</span>
                                    <h4 class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }}">Player com Maior Nível</h4>
                                </div>
                                <label class="cor_fontes_{{ $temas[3] }}">
                                    @php
                                    
                                        $perfil = asset("assets/images/perfils/" . strtolower($player_lider_nivel->personagem->classe) . ".png");

                                        if ($player_lider_nivel->foto != "photos/vazio.png") {
                                            $perfil = asset($player_lider_nivel->foto);
                                        }
                                    @endphp
                                    <div class="d-flex flex-wrap justify-content-center">
                                        Usuário:
                                        <img src="{{ $perfil }}" class="sombras perfil_players border border-{{ $temas[1] }} rounded-circle ms-1 me-2">
                                        <div class="bandeiras d-flex border-3 border-start border-black rounded-top-1">
                                            <i class="fi fi-{{ strtolower($player_lider_nivel->pais) }} animate__animated animate__jello animate__infinite border-start border-end mb-1 me-1"></i>
                                        </div>
                                        {{ $player_lider_nivel->user }}
                                    </div>
                                </label>
                                <label class="cor_fontes_{{ $temas[3] }}">Nível: {{ $player_lider_nivel->nivel }}</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sombras tabelas card animate__animated animate__fadeInUp bg-{{ $temas[0] }} border-{{ $temas[1] }} p-3 overflow-x-auto">
                    <div class="tabelas-scroll">
                        <table id="tabela" class="border border-2 border-{{ $temas[1] }} w-100">
                            <thead class="text-center">
                                <tr>
                                    <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center fs-5 px-1">
                                        <i class="bi bi-list-ol titulos_colunas"></i>Nº
                                    </th>
                                    <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center fs-5 px-1">
                                        <i class="bi bi-person-bounding-box titulos_colunas"></i>Perfil
                                    </th>
                                    <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center fs-5 px-1">
                                        <i class="bi bi-person-fill titulos_colunas"></i>Usuario/Status
                                    </th>
                                    <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center fs-5 px-1">
                                        <i class="bi bi-person-arms-up titulos_colunas"></i>Classe
                                    </th>
                                    <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center fs-5 px-1">
                                        <i class="bi bi-arrow-up-circle-fill titulos_colunas"></i>Nível
                                    </th>
                                    <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center fs-5 px-1">
                                        <i class="bi bi-123 titulos_colunas"></i>Qtd/Vitórias
                                    </th>
                                    <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center fs-5 px-1">
                                        <i class="bi bi-123 titulos_colunas"></i>Qtd/Derrotas
                                    </th>
                                    <th class="border-{{ $temas[1] }} border text-center fs-5 px-1">⚔️</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($players as $player)
                                    <x-players
                                        :player="$player"
                                        :temas="$temas"
                                        :desafiou="$desafiou"
                                        :loop="$loop->index"
                                    />
                                @empty
                                    <tr class="text-center">
                                        <td colspan="8" class="cor_fontes_{{ $temas[3] }}">NENHUM PLAYER EXISTENTE AINDA</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include("layouts.partials.scripts.tabelas")    
@endsection