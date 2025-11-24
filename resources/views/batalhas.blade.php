@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="{{ session("tema") == "escuro" ? "fundos_card_claro" : "fundos_card_escuro" }} card p-3">
            <div class="d-grid gap-3 w-100">
                <div class="sombras tabelas card animate__animated animate__fadeInUp {{ session("tema") == "escuro" ? "bg-secondary border-primary" : "bg-dark border-danger" }} p-3 overflow-x-auto">
                    <div class="tabelas-scroll">
                        <table class="border border-2 {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} w-100">
                            <thead class="text-center">
                                <th class="{{ session("tema") == "escuro" ? "titulos_escuro cor_fontes_escuro border-primary" : "titulos_claro cor_fontes_claro border-danger" }} border"><i class="bi bi-list-ol"></i>Nº</th>
                                <th class="{{ session("tema") == "escuro" ? "titulos_escuro cor_fontes_escuro border-primary" : "titulos_claro cor_fontes_claro border-danger" }} border">Player</th>
                                <th class="{{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} border">❤️</th>
                                <th class="{{ session("tema") == "escuro" ? "titulos_escuro cor_fontes_escuro border-primary" : "titulos_claro cor_fontes_claro border-danger" }} border">VS</th>
                                <th class="{{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} border">❤️</th>
                                <th class="{{ session("tema") == "escuro" ? "titulos_escuro cor_fontes_escuro border-primary" : "titulos_claro cor_fontes_claro border-danger" }} border">Oponente</th>
                            </thead>

                            <tbody>
                                @forelse ($batalhas as $batalha)
                                    
                                @empty
                                    <tr class="text-center">
                                        <td colspan="6" class="{{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}">NENHUMA BATALHA ACONTECENDO NO MOMENTO</td>
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