@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="fundos_card_{{ $temas[2] }} card p-3">
            <div class="row row-cols-1 row-cols-md-2 d-flex justify-content-center g-3">
                @foreach ($regras as $regra)
                    <x-regras
                        :regra="$regra"
                        :temas="$temas"                        
                    />
                @endforeach
            </div>            
        </div>
    </div>
@endsection