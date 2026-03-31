<tr>
    <td class="cor_fontes_{{ $temas[3] }} border-{{ $temas[1] }} border text-center fw-bold">{{ $loop + 1 }}</td>
    <td class="border-{{ $temas[1] }} border text-center px-1">
        <img src="
            @if ($player->foto == "photos/vazio.png")
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
            {{ $player->user }}
            {{ $player->online == true ? "🟢" : "🔴" }}
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