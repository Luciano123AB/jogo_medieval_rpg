@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="fundos_card_{{ $temas[4] }} card p-3">
            <div class="d-grid gap-3 w-100">
                <div class="sombras animate__animated animate__zoomInLeft card bg-{{ $temas[0] }} border-{{ $temas[1] }} p-3">
                    <form action="{{ route("confirmar.atualizar") }}" method="post" enctype="multipart/form-data" novalidate>
                        @csrf

                        <div class="card-header border border-2 border-{{ $temas[1] }} text-center rounded-top">
                            <i class="bi bi-arrow-repeat titulos_{{ $temas[4] }} cor_fontes_{{ $temas[4] }} fs-5"></i>
                            <Label class="titulos_{{ $temas[4] }} cor_fontes_{{ $temas[4] }} fw-bold fs-5">Atualizar Player</Label>
                        </div>

                        <div class="card-body border-start border-2 border-end border-{{ $temas[1] }}">
                            <label class="form-label cor_fontes_{{ $temas[4] }}">Novo Usuário:</label>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text cor_fontes_{{ $temas[4] }} bg-{{ $temas[2] }} border-{{ $temas[1] }}">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                    <input type="text" id="novo_usuario" class="form-control cursor bg-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring focus-ring-{{ $temas[1] }} text-{{ $temas[3] }}" name="novo_usuario" placeholder="Usuario123" aria-label="Usuario123" aria-describedby="NovoUsuario" value="{{ old("novo_usuario", $dados["usuario"]) }}">
                                </div>
                                @error("novo_usuario")
                                    <div class="alert alert-danger animate__animated animate__shakeX bg-danger mt-1 mb-0" role="alert">
                                        <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <label class="form-label cor_fontes_{{ $temas[4] }}">Novo Email:</label>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text cor_fontes_{{ $temas[4] }} bg-{{ $temas[2] }} border-{{ $temas[1] }}">
                                        <i class="bi bi-envelope-at-fill"></i>
                                    </span>
                                    <input type="email" id="novo_email" class="form-control cursor bg-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring focus-ring-{{ $temas[1] }} text-{{ $temas[3] }}" name="novo_email" placeholder="usuario@gmail.com" aria-label="usuario@gmail.com" aria-describedby="NovoEmail" value="{{ old("novo_email", $dados["email"]) }}">
                                </div>
                                @error("novo_email")
                                    <div class="alert alert-danger animate__animated animate__shakeX bg-danger mt-1 mb-0" role="alert">
                                        <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
    
                            <div class="d-flex gap-3">
                                <div class="horizontal_vertical gap-3">
                                    <div>
                                        <label class="form-label cor_fontes_{{ $temas[4] }}">Nova Classe:</label>
                                        <div class="input-group">
                                            <span class="input-group-text cor_fontes_{{ $temas[4] }} bg-{{ $temas[2] }} border-{{ $temas[1] }}">
                                                <i class="bi bi-sort-down"></i>
                                            </span>
                                            <select id="classe" class="form-select cursor bg-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring focus-ring-{{ $temas[1] }} text-{{ $temas[3] }}" name="classe" aria-label="Classes">
                                                <option selected>Selecione sua classe...</option>
                                                @foreach ($personagens as $personagem)
                                                    <option value="{{ $personagem->classe }}" {{ old("classe", $dados["classe"]) == "$personagem->classe" ? "selected" : "" }}>
                                                        @if($personagem->classe == "Guerreiro")
                                                            🛡️
                                                        @elseif($personagem->classe == "Mago")
                                                            🔮
                                                        @else
                                                            🗡️
                                                        @endif
                                                        {{ $personagem->classe }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error("classe")
                                            <div class="alert alert-danger animate__animated animate__shakeX bg-danger mt-1 mb-0" role="alert">
                                                <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="d-grid justify-content-center">
                                        <label class="form-label cor_fontes_{{ $temas[4] }}">
                                            <i class="bi bi-person-circle"></i>
                                            Personagem:
                                        </label>
                                        <div>
                                            <img src="{{ asset('assets/images/perfils/' . strtolower($dados["classe"]) . '.png') }}" class="
                                                @if($dados["classe"] == "Guerreiro")
                                                    bg-danger border-danger
                                                @elseif($dados["classe"] == "Mago")
                                                    bg-primary border-primary
                                                @elseif($dados["classe"] == "Assassino")
                                                    bg-black border-black
                                                @endif
                                                perfil_cadastro border border-3 rounded-circle
                                            ">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label cor_fontes_{{ $temas[4] }}">Nova Foto (Opcional):</label>
                                        <div class="d-grid">
                                            <div class="input-group">
                                                <span class="input-group-text cor_fontes_{{ $temas[4] }} bg-{{ $temas[2] }} border-{{ $temas[1] }}">
                                                    <i class="bi bi-file-earmark-person-fill"></i>
                                                </span>
                                                <input id="foto" class="form-control cursor bg-{{ $temas[2] }} border border-{{ $temas[1] }} focus-ring focus-ring-{{ $temas[1] }} text-{{ $temas[3] }}" type="file" name="foto" accept="image/png, image/jpeg">
                                            </div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input cursor focus-ring border-{{ $temas[1] }} focus-ring-{{ $temas[1] }}" id="sem_foto" type="checkbox" name="sem_foto" value="nenhuma">
                                                <label class="form-check-label" for="sem_foto">
                                                    <span class="cursor cor_fontes_{{ $temas[4] }}">Sem Foto</span>
                                                </label>
                                            </div>
                                        </div>
                                        @error("foto")
                                            <div class="alert alert-danger animate__animated animate__shakeX bg-danger mt-1" role="alert">
                                                <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="d-grid justify-content-center">
                                        <label class="form-label cor_fontes_{{ $temas[4] }}">
                                            <i class="bi bi-person-bounding-box"></i>
                                            Perfil:
                                        </label>
                                        <div>
                                            <img src="{{ asset($dados["foto"]) }}" alt="Foto Preview" id="foto_preview" class="perfil_cadastro border border-3 rounded-circle">
                                        </div>
                                    </div>
                                </div>    
                            </div>    
                            @error("playerExiste")
                                <div class="d-flex justify-content-center">
                                    <div class="alert alert-danger animate__animated animate__shakeX bg-danger text-center w-50" role="alert">
                                        <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                    </div>
                                </div>
                            @enderror
                        </div>

                        <div class="card-footer border border-2 border-{{ $temas[1] }} d-flex justify-content-center gap-3 text-center py-3">
                            <button type="submit" class="cursor sombras botoes btn focus-ring btn-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }}">
                                <span class="cursor cor_fontes_{{ $temas[4] }} d-flex justify-content-center">
                                    <div class="cursor animate__animated animate__heartBeat animate__infinite">
                                        <i class="cursor bi bi-save-fill me-1"></i>
                                    </div>
                                    Atualizar
                                </span>
                            </button>
                            <button type="button" class="cursor sombras botoes btn focus-ring btn-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }}" onclick="limparCampos()">
                                <span class="cursor cor_fontes_{{ $temas[4] }} d-flex justify-content-center">
                                    <div class="cursor animate__animated animate__bounceOut animate__infinite">
                                        <i class="cursor bi bi-x-circle-fill me-1"></i>
                                    </div>
                                    Limpar
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include("layouts.partials.scripts.cadastro_atualizacao")
@endsection