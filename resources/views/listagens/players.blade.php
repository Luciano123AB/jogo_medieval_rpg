@extends("layouts.main_layout")

@section("content")
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

                                        if ($player_lider_vitorias->foto != "fotos/vazio.png") {
                                            $perfil = asset($player_lider_vitorias->foto);
                                        }
                                    @endphp
                                    <div class="d-flex flex-wrap justify-content-center">
                                        Usuário:
                                        <img src="{{ $perfil }}" class="sombras perfil_players border border-{{ $temas[1] }} rounded-circle ms-1 me-2">
                                        <div class="bandeiras d-flex border-3 border-start border-black rounded-top-1">
                                            <i class="fi fi-{{ strtolower($player_lider_vitorias->pais) }} animate__animated animate__jello animate__infinite border-start border-end mb-1 me-1"></i>
                                        </div>
                                        {{ $player_lider_vitorias->usuario }}
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

                                        if ($player_lider_nivel->foto != "fotos/vazio.png") {
                                            $perfil = asset($player_lider_nivel->foto);
                                        }
                                    @endphp
                                    <div class="d-flex flex-wrap justify-content-center">
                                        Usuário:
                                        <img src="{{ $perfil }}" class="sombras perfil_players border border-{{ $temas[1] }} rounded-circle ms-1 me-2">
                                        <div class="bandeiras d-flex border-3 border-start border-black rounded-top-1">
                                            <i class="fi fi-{{ strtolower($player_lider_nivel->pais) }} animate__animated animate__jello animate__infinite border-start border-end mb-1 me-1"></i>
                                        </div>
                                        {{ $player_lider_nivel->usuario }}
                                    </div>
                                </label>
                                <label class="cor_fontes_{{ $temas[3] }}">Nível: {{ $player_lider_nivel->nivel }}</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sombras tabelas card animate__animated animate__fadeInUp bg-{{ $temas[0] }} border-{{ $temas[1] }} p-3 overflow-x-auto">
                    <div class="tabelas-scroll">
                        <table class="border border-2 border-{{ $temas[1] }} w-100">
                            <thead class="text-center">
                                <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border fs-5 px-1">
                                    <i class="bi bi-list-ol"></i>
                                    Nº
                                </th>
                                <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border fs-5 px-1">
                                    <i class="bi bi-person-bounding-box"></i>
                                    Perfil
                                </th>
                                <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border fs-5">
                                    <i class="bi bi-person-fill"></i>
                                    Usuario
                                </th>
                                <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border fs-5 px-1">
                                    <i class="bi bi-person-arms-up"></i>
                                    Classe
                                </th>
                                <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border fs-5 px-1">
                                    <i class="bi bi-arrow-up-circle-fill"></i>
                                    Nível
                                </th>
                                <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border fs-5 px-1">
                                    <i class="bi bi-123"></i>
                                    Qtd/Vitórias
                                </th>
                                <th class="titulos_{{ $temas[3] }} cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border fs-5 px-1">
                                    <i class="bi bi-123"></i>
                                    Qtd/Derrotas
                                </th>
                                <th class="border-{{ $temas[1] }} border fs-5 px-1">⚔️</th>
                            </thead>

                            <tbody>
                                @forelse ($players as $player)
                                    <tr>
                                        <td class="cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center fw-bold">{{ $loop->index + 1 }}</td>
                                        <td class="border-{{ $temas[1] }} border text-center px-1">
                                            <img src="
                                                @if ($player->foto == "fotos/vazio.png")
                                                    {{ asset("assets/images/perfils/" . strtolower($player->personagem->classe) . ".png") }}
                                                @else
                                                    {{ asset($player->foto) }}
                                                @endif
                                            " class="perfil_player sombras border border-{{ $temas[1] }} rounded-circle">
                                        </td>
                                        <td class="cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border px-1">
                                            <div class="d-flex flex-wrap">
                                                <div class="bandeiras d-flex border-3 border-start border-black rounded-top-1 me-1">
                                                    <i class="fi fi-{{ strtolower($player->pais) }} animate__animated animate__jello animate__infinite border-start border-end mb-1 me-1"></i>
                                                    
                                                    @if($player->genero == "Masculino")
                                                        ♂️
                                                    @elseif($player->genero == "Feminino")
                                                        ♀️
                                                    @else
                                                        ⚧
                                                    @endif
                                                </div>
                                                {{ $player->usuario }}
                                            </div>
                                        </td>
                                        <td class="cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center px-1">{{ $player->personagem->classe }}</td>
                                        <td class="cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center">{{ $player->nivel }}</td>
                                        <td class="cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center">{{ $player->quantidade_vitorias }}</td>
                                        <td class="cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center">{{ $player->quantidade_derrotas }}</td>
                                        <td id="desafiar" class="cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center">
                                            @if($player->id != Auth::user()->id)
                                                @if(in_array($player->id, $desafiou))
                                                    <button type="button" class="cursor sombras botoes btn btn-sm focus-ring btn-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} mx-1" disabled>
                                                        <span class="cursor cor_fontes_{{ $temas[3] }}">🤜🏼Desafiar</span>
                                                    </button>
                                                @else
                                                    <form action="{{ route("confirmarDesafio", ["id" => $player->id_crypt]) }}" method="POST">
                                                        @csrf

                                                        <button type="sumit" class="cursor sombras botoes btn btn-sm focus-ring btn-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} mx-1">
                                                            <span class="cursor cor_fontes_{{ $temas[3] }}">🤜🏼Desafiar</span>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
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
@endsection