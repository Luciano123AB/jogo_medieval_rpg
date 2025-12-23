@extends("layouts.main_layout")

@section("content")
    @php

        $temas = ["secondary", "primary", "escuro"];
        
        if (session("tema") == "claro" || !session()->has("tema")) {
            $temas = ["dark", "danger", "claro"];
        }
    @endphp

    <div class="container">
        <div class="fundos_card_{{ $temas[2] }} card p-3">
            <div class="d-grid gap-3 w-100">
                <div class="sombras tabelas card animate__animated animate__zoomInRight bg-{{ $temas[0] }} border-{{ $temas[1] }} p-3 overflow-x-auto">
                    <div class="tabelas-scroll">
                        <table class="border border-2 border-{{ $temas[1] }} w-100">
                            <thead class="text-center">
                                <th class="titulos_{{ $temas[2] }} cor_fontes_{{ $temas[2] }} border-{{ $temas[1] }} border px-1"><i class="bi bi-list-ol"></i>Nº</th>
                                <th class="titulos_{{ $temas[2] }} cor_fontes_{{ $temas[2] }} border-{{ $temas[1] }} border">Player</th>
                                <th class="border-{{ $temas[1] }} border">❤️</th>
                                <th class="titulos_{{ $temas[2] }} cor_fontes_{{ $temas[2] }} border-{{ $temas[1] }} border px-1">VS</th>
                                <th class="border-{{ $temas[1] }} border">❤️</th>
                                <th class="titulos_{{ $temas[2] }} cor_fontes_{{ $temas[2] }} border-{{ $temas[1] }} border">Oponente</th>
                            </thead>

                            <tbody>
                                @forelse ($batalhas as $batalha)
                                    <tr>
                                        <td class="cor_fontes_{{ $temas[2] }} border-{{ $temas[1] }} border text-center fw-bold">{{ $loop->index + 1 }}</td>
                                        <td class="border-{{ $temas[1] }} border text-success text-center fw-bold px-1">{{ $batalha->nome }}</td>
                                        <td class="cor_fontes_{{ $temas[2] }} border-{{ $temas[1] }} border text-center">
                                            <div class="barras progress border border-danger bg-black mx-1" role="progressbar" aria-label="Animated striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                <div id="hp" class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width: 100%">
                                                    <label class="fw-bold fs-6">{{ $batalha->hp }}</label>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-{{ $temas[1] }} border text-center">🆚</td>
                                        <td class="cor_fontes_{{ $temas[2] }} border-{{ $temas[1] }} border text-center">
                                            <div class="barras progress border border-danger bg-black mx-1" role="progressbar" aria-label="Animated striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                <div id="hp_oponente" class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width: 100%">
                                                    <label class="fw-bold fs-6">{{ $batalha->hp_oponente }}</label>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-{{ $temas[1] }} border text-danger text-center fw-bold px-1">{{ $batalha->nome_oponente }}</td>
                                    </tr>

                                    <script>

                                        const hp_player = {{ $batalha->hp }};
                                        const hp_maximo_player = {{ $batalha->hp_maximo }};
                                        const hp_barra_player = document.getElementById("hp");

                                        const hp_oponente = {{ $batalha->hp_oponente }};
                                        const hp_maximo_oponente = {{ $batalha->hp_maximo_oponente }};
                                        const hp_barra_oponente = document.getElementById("hp_oponente");

                                        function calcularPorcentagem(atual, maximo) {
                                            return (atual / maximo) * 100;
                                        }

                                        hp_barra_player.style.width = calcularPorcentagem(hp_player, hp_maximo_player) + "%";
                                        hp_barra_oponente.style.width = calcularPorcentagem(hp_oponente, hp_maximo_oponente) + "%";

                                        if (calcularPorcentagem(hp_player, hp_maximo_player) <= 10 || calcularPorcentagem(hp_oponente, hp_maximo_oponente) <= 10) {
                                            alerta.textContent = "Momento Decisivo!";
                                        }
                                    </script>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="6" class="cor_fontes_{{ $temas[2] }}">NENHUMA BATALHA ACONTECENDO NO MOMENTO</td>
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