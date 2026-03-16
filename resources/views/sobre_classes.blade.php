@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="fundos_card_{{ $temas[2] }} card p-3">
            <div class="animate__animated animate__fadeInLeft card-group gap-3 w-100">
                @foreach ($personagens as $personagem)
                    <x-personagem-component
                        :personagem="$personagem"
                        :temas="$temas"
                    />
                @endforeach
            </div>
        </div>
    </div>
@endsection