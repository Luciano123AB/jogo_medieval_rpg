@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="fundos_card_{{ $temas[4] }} card p-3">
            <div class="d-grid gap-3 w-100">
                <div class="sombras animate__animated animate__zoomInLeft card bg-{{ $temas[0] }} border-{{ $temas[1] }} p-3">
                    @php

                        $rota = "confirmarCadastrar";
                        $titulo = "Novo Player";
                        $id = "";
                        $values = ["", "", ""];
                        $classe = "vazio";

                        if ($pagina == "Atualização") {
                            $rota = "confirmarAtualizar";
                            $titulo = "Atualizar Player";
                            $id = $dados["id"];
                            $values = [$dados["usuario"], $dados["email"], $dados["classe"]];
                            $classe = $values[2];
                        }
                    @endphp

                    <form action="{{ route("$rota") }}" method="post" enctype="multipart/form-data" novalidate>
                        @csrf

                        <input type="hidden" name="id" value="{{ $id }}">

                        <div class="card-header border border-2 border-{{ $temas[1] }} text-center rounded-top">
                            @if ($pagina == "Cadastro")
                                <i class="bi bi-plus-circle-fill titulos_{{ $temas[4] }} cor_fontes_{{ $temas[4] }} fs-5"></i>
                            @else
                                <i class="bi bi-arrow-repeat titulos_{{ $temas[4] }} cor_fontes_{{ $temas[4] }} fs-5"></i>
                            @endif
                            <Label class="titulos_{{ $temas[4] }} cor_fontes_{{ $temas[4] }} fw-bold fs-5">{{ $titulo }}</Label>
                        </div>

                        <div class="card-body border-start border-2 border-end border-{{ $temas[1] }}">
                            <label class="form-label cor_fontes_{{ $temas[4] }}">{{ $pagina == "Cadastro" ? "Usuário" : "Novo Usuário" }}:</label>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text cor_fontes_{{ $temas[4] }} bg-{{ $temas[2] }} border-{{ $temas[1] }}">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                    <input type="text" id="novo_usuario" class="form-control cursor bg-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring focus-ring-{{ $temas[1] }} text-{{ $temas[3] }}" name="novo_usuario" placeholder="Usuario123" aria-label="Usuario123" aria-describedby="NovoUsuario" value="{{ old("novo_usuario", $values[0]) }}">
                                </div>
                                @error("novo_usuario")
                                    <div class="alert alert-danger animate__animated animate__shakeX bg-danger mt-1 mb-0" role="alert">
                                        <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <label class="form-label cor_fontes_{{ $temas[4] }}">{{ $pagina == "Cadastro" ? "Email" : "Novo Email" }}:</label>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text cor_fontes_{{ $temas[4] }} bg-{{ $temas[2] }} border-{{ $temas[1] }}">
                                        <i class="bi bi-envelope-at-fill"></i>
                                    </span>
                                    <input type="email" id="novo_email" class="form-control cursor bg-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring focus-ring-{{ $temas[1] }} text-{{ $temas[3] }}" name="novo_email" placeholder="usuario@gmail.com" aria-label="usuario@gmail.com" aria-describedby="NovoEmail" value="{{ old("novo_email", $values[1]) }}">
                                </div>
                                @error("novo_email")
                                    <div class="alert alert-danger animate__animated animate__shakeX bg-danger mt-1 mb-0" role="alert">
                                        <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            @if($pagina != "Atualização")
                                <label class="form-label cor_fontes_{{ $temas[4] }}">Senha:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text cor_fontes_{{ $temas[4] }} bg-{{ $temas[2] }} border-{{ $temas[1] }}">***</span>
                                        <input type="password" id="nova_senha" class="form-control cursor bg-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring focus-ring-{{ $temas[1] }} text-{{ $temas[3] }}" name="nova_senha" placeholder="..." aria-label="..." aria-describedby="NovaSenha" value="{{ old("nova_senha") }}">
                                        <button type="button" id="mostrar_novo" class="cursor input-group-text cor_fontes_{{ $temas[4] }} bg-{{ $temas[2] }} border-{{ $temas[1] }}">
                                            <i class="cursor bi bi-eye-slash-fill"></i>
                                        </button>
                                    </div>
                                    @error("nova_senha")
                                        <div class="alert alert-danger animate__animated animate__shakeX bg-danger mt-1 mb-0" role="alert">
                                            <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                        </div>
                                    @enderror
                                    @error("senhas")
                                        <div class="alert alert-danger animate__animated animate__shakeX bg-danger mt-1 mb-0" role="alert">
                                            <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <label class="form-label cor_fontes_{{ $temas[4] }}">Confirmar Senha:</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text cor_fontes_{{ $temas[4] }} bg-{{ $temas[2] }} border-{{ $temas[1] }}">***</span>
                                        <input type="password" id="confirmar_nova_senha" class="form-control cursor bg-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring focus-ring-{{ $temas[1] }} text-{{ $temas[3] }}" name="confirmar_nova_senha" placeholder="..." aria-label="..." aria-describedby="ConfirmarNovaSenha" value="{{ old("confirmar_nova_senha") }}">
                                        <button type="button" id="mostrar_confirmar_novo" class="cursor input-group-text cor_fontes_{{ $temas[4] }} bg-{{ $temas[2] }} border-{{ $temas[1] }}">
                                            <i class="cursor bi bi-eye-slash-fill"></i>
                                        </button>
                                    </div>
                                    @error("confirmar_nova_senha")
                                        <div class="alert alert-danger animate__animated animate__shakeX bg-danger mt-1 mb-0" role="alert">
                                            <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                        </div>
                                    @enderror
                                    @error("senhas")
                                        <div class="alert alert-danger animate__animated animate__shakeX bg-danger mt-1 mb-0" role="alert">
                                            <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="horizontal_vertical">
                                    <div class="mb-3 me-3">
                                        <label class="form-label cor_fontes_{{ $temas[4] }}">Gênero:</label>
                                        <div class="d-flex">
                                            <div>
                                                <div class="input-group">
                                                    <span class="input-group-text cor_fontes_{{ $temas[4] }} bg-{{ $temas[2] }} border-{{ $temas[1] }}">
                                                        <i class="bi bi-sort-down"></i>
                                                    </span>
                                                    <select id="genero" class="form-select cursor bg-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring focus-ring-{{ $temas[1] }} text-{{ $temas[3] }}" name="genero" aria-label="Generos">
                                                        <option selected>Selecione seu gênero...</option>
                                                        <option value="Masculino" {{ old("genero") == "Masculino" ? "selected" : "" }}>♂️ Masculino</option>
                                                        <option value="Feminino" {{ old("genero") == "Feminino" ? "selected" : "" }}>♀️ Feminino</option>
                                                        <option value="Outro" {{ old("genero") == "Outro" ? "selected" : "" }}>⚧ Outro</option>
                                                    </select>
                                                </div>
                                                @error("genero")
                                                    <div class="alert alert-danger animate__animated animate__shakeX bg-danger mt-1 mb-0" role="alert">
                                                        <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div id="lista_bandeiras">
                                        <label class="form-label cor_fontes_{{ $temas[4] }}">País:</label>
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <span class="input-group-text cor_fontes_{{ $temas[4] }} bg-{{ $temas[2] }} border-{{ $temas[1] }}">
                                                    <i class="bi bi-flag-fill"></i>
                                                </span>

                                                <div id="countrySelect" class="form-control cursor p-0 bg-{{ $temas[2] }} border-{{ $temas[1] }} text-{{ $temas[3] }}">
                                                    @php

                                                        $pais_antigo = old("pais");

                                                    @endphp

                                                    <div class="cursor selected-option d-flex align-items-center gap-2 p-1">
                                                        @if($pais_antigo)
                                                            <span class="fi fi-{{ strtolower($pais_antigo) }} ms-1"></span> 
                                                            {{ $paises[$pais_antigo] }}
                                                        @else
                                                            🌐 Selecione seu país...
                                                        @endif
                                                    </div>

                                                    <div id="paises" class="options border-top border-{{ $temas[1] }} rounded mt-1">
                                                        @foreach($paises as $codigo => $nome)
                                                            <div class="cursor option d-flex border-bottom border-{{ $temas[1] }} align-items-center gap-2 p-1" data-value="{{ $codigo }}">
                                                                <span class="fi fi-{{ strtolower($codigo) }} ms-1"></span> 
                                                                {{ $nome }}
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <input type="hidden" name="pais" id="pais" value="{{ $pais_antigo }}">
                                                </div>
                                            </div>
                                            @error("pais")
                                                <div class="alert alert-danger animate__animated animate__shakeX bg-danger mt-1 mb-0" role="alert">
                                                    <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif
    
                            <div class="d-flex gap-3">
                                <div class="horizontal_vertical gap-3">
                                    <div>
                                        <label class="form-label cor_fontes_{{ $temas[4] }}">{{ $pagina == "Cadastro" ? "Classe" : "Nova Classe" }}:</label>
                                        <div class="input-group">
                                            <span class="input-group-text cor_fontes_{{ $temas[4] }} bg-{{ $temas[2] }} border-{{ $temas[1] }}">
                                                <i class="bi bi-sort-down"></i>
                                            </span>
                                            <select id="classe" class="form-select cursor bg-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring focus-ring-{{ $temas[1] }} text-{{ $temas[3] }}" name="classe" aria-label="Classes">
                                                <option selected>Selecione sua classe...</option>
                                                @foreach ($personagens as $personagem)
                                                    <option value="{{ $personagem->classe }}" {{ old("classe", $values[2]) == "$personagem->classe" ? "selected" : "" }}>
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

                                    <div>
                                        <label class="form-label cor_fontes_{{ $temas[4] }}">
                                            <i class="bi bi-person-circle"></i>
                                            Personagem:
                                        </label>
                                        <div>
                                            @if($pagina != "Atualização")
                                                <img src="{{ asset('fotos/vazio.png') }}" class="perfil_cadastro border border-3 rounded-circle">
                                            @else
                                                <img src="{{ asset('assets/images/perfils/' . strtolower($classe) . '.png') }}" class="
                                                    @if($classe == "Guerreiro")
                                                        bg-danger border-danger
                                                    @elseif($classe == "Mago")
                                                        bg-primary border-primary
                                                    @elseif($classe == "Assassino")
                                                        bg-dark border-dark
                                                    @endif
                                                    perfil_cadastro border border-3 rounded-circle
                                                ">
                                            @endif
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label cor_fontes_{{ $temas[4] }}">{{ $pagina == "Cadastro" ? "Foto (Opcional)" : "Nova Foto (Opcional)" }}:</label>
                                        <div class="d-grid">
                                            <div class="input-group">
                                                <span class="input-group-text cor_fontes_{{ $temas[4] }} bg-{{ $temas[2] }} border-{{ $temas[1] }}">
                                                    <i class="bi bi-file-earmark-person-fill"></i>
                                                </span>
                                                <input id="foto" class="form-control cursor bg-{{ $temas[2] }} border border-{{ $temas[1] }} focus-ring focus-ring-{{ $temas[1] }} text-{{ $temas[3] }}" type="file" name="foto" accept="image/png, image/jpeg">
                                            </div>
                                            @if($pagina == "Atualização")
                                                <div class="form-check mt-2">
                                                    <input class="form-check-input cursor focus-ring border-{{ $temas[1] }} focus-ring-{{ $temas[1] }}" id="sem_foto" type="checkbox" name="sem_foto" value="nenhuma">
                                                    <label class="form-check-label" for="sem_foto">
                                                        <span class="cursor cor_fontes_{{ $temas[4] }}">Sem Foto</span>
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                        @error("foto")
                                            <div class="alert alert-danger animate__animated animate__shakeX bg-danger mt-1" role="alert">
                                                <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="form-label cor_fontes_{{ $temas[4] }}">
                                            <i class="bi bi-person-bounding-box"></i>
                                            Perfil:
                                        </label>
                                        @php
                                            
                                            $foto = asset("fotos/vazio.png");

                                            if ($pagina == "Atualização") {
                                                $foto = asset($dados["foto"]);
                                            }
                                        @endphp
                                        <div>
                                            <img src="{{ $foto }}" alt="Foto Preview" id="foto_preview" class="perfil_cadastro border border-3 rounded-circle">
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
                                        @if ($pagina == "Cadastro")
                                            <i class="cursor bi bi-person-plus-fill me-1"></i>
                                        @else
                                            <i class="cursor bi bi-save-fill me-1"></i>
                                        @endif
                                    </div>
                                    {{ $pagina == "Cadastro" ? "Cadastrar" : "Atualizar" }}
                                </span>
                            </button>
                            <button type="button" class="cursor sombras botoes btn focus-ring btn-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }}" onclick="limparCamposCadastro()">
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
@endsection