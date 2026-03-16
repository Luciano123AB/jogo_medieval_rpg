@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="fundos_card_{{ $temas[2] }} card p-3">
            <div id="total_players" class="gap-3">
                @foreach ($totais as $codigo => $dados)
                    <x-totais
                        :dados="$dados"
                        :codigo="$codigo"
                        :temas="$temas"
                    />
                @endforeach
            </div>
        </div>
    </div>
@endsection