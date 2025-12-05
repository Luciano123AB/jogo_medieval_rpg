@extends("layouts.main_layout")

@section("content")
    <div class="container w-75">
        <div class="{{ session("tema") == "escuro" ? "fundos_card_claro" : "fundos_card_escuro" }} card p-3">
            <div class="d-grid gap-3">
                <div class="sombras animate__animated animate__zoomInLeft card {{ session("tema") == "escuro" ? "bg-secondary border-primary" : "bg-black border-danger" }} p-3">
                    @php

                        $rota = "confirmarCadastrar";
                        $titulo = "Novo Player";
                        $id = "";
                        $values = ["", "", "", "", ""];
                        $classe = "vazio";

                        if ($pagina == "Atualização") {
                            
                            $rota = "confirmarAtualizar";
                            $titulo = "Atualizar Player";
                            $id = $dados["id"];
                            $values = [$dados["usuario"], $dados["email"], $dados["senha"], $dados["confirmar_senha"], $dados["classe"]];
                            $classe = $values[4];

                        }
                    @endphp

                    <form action="{{ route("$rota") }}" method="post" enctype="multipart/form-data" novalidate>
                        @csrf

                        <input type="hidden" name="id" value="{{ $id }}">

                        <div class="card-header border border-2 {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} text-center rounded-top">
                            @if ($pagina == "Cadastro")
                                <i class="bi bi-plus-circle-fill {{ session("tema") == "escuro" ? "titulos_escuro cor_fontes_escuro" : "titulos_claro cor_fontes_claro" }} fs-5"></i>
                            @else
                                <i class="bi bi-arrow-repeat {{ session("tema") == "escuro" ? "titulos_escuro cor_fontes_escuro" : "titulos_claro cor_fontes_claro" }} fs-5"></i>
                            @endif
                            <Label class="{{ session("tema") == "escuro" ? "titulos_escuro cor_fontes_escuro" : "titulos_claro cor_fontes_claro" }} fw-bold fs-5">{{ $titulo }}</Label>
                        </div>

                        <div class="card-body border-start border-2 border-end {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }}">
                            <label class="form-label {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}">{{ $pagina == "Cadastro" ? "Usuário" : "Novo Usuário" }}:</label>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text {{ session("tema") == "escuro" ? "cor_fontes_escuro bg-light border-primary" : "cor_fontes_claro bg-dark border-danger" }}"><i class="bi bi-person-fill"></i></span>
                                    <input type="text" id="novo_usuario" class="form-control cursor {{ session("tema") == "escuro" ? "bg-light border-primary text-black" : "bg-dark border-danger text-white" }}" name="novo_usuario" placeholder="Usuario123" aria-label="Usuario123" aria-describedby="NovoUsuario" value="{{ old("novo_usuario", $values[0]) }}">
                                </div>

                                @error("novo_usuario")
                                    <div class="alert alert-danger animate__animated animate__shakeX mt-1 mb-0" role="alert">
                                        <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <label class="form-label {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}">{{ $pagina == "Cadastro" ? "Email" : "Novo Email" }}:</label>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text {{ session("tema") == "escuro" ? "cor_fontes_escuro bg-light border-primary" : "cor_fontes_claro bg-dark border-danger" }}"><i class="bi bi-envelope-at-fill"></i></span>
                                    <input type="email" id="novo_email" class="form-control cursor {{ session("tema") == "escuro" ? "bg-light border-primary text-black" : "bg-dark border-danger text-white" }}" name="novo_email" placeholder="usuario@gmail.com" aria-label="usuario@gmail.com" aria-describedby="NovoEmail" value="{{ old("novo_email", $values[1]) }}">
                                </div>

                                @error("novo_email")
                                    <div class="alert alert-danger animate__animated animate__shakeX mt-1 mb-0" role="alert">
                                        <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
    
                            <label class="form-label {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}">{{ $pagina == "Cadastro" ? "Senha" : "Nova Senha" }}:</label>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text {{ session("tema") == "escuro" ? "cor_fontes_escuro bg-light border-primary" : "cor_fontes_claro bg-dark border-danger" }}">***</span>
                                    <input type="password" id="nova_senha" class="form-control cursor {{ session("tema") == "escuro" ? "bg-light border-primary text-black" : "bg-dark border-danger text-white" }}" name="nova_senha" placeholder="..." aria-label="..." aria-describedby="NovaSenha" value="{{ old("nova_senha", $values[2]) }}">
                                    <button type="button" id="mostrar_novo" class="cursor input-group-text {{ session("tema") == "escuro" ? "cor_fontes_escuro bg-light border-primary" : "cor_fontes_claro bg-dark border-danger" }}"><i class="cursor bi bi-eye-slash-fill"></i></button>
                                </div>

                                @error("nova_senha")
                                    <div class="alert alert-danger animate__animated animate__shakeX mt-1 mb-0" role="alert">
                                        <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                    </div>
                                @enderror
                                @error("senhas")
                                    <div class="alert alert-danger animate__animated animate__shakeX mt-1 mb-0" role="alert">
                                        <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <label class="form-label {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}">{{ $pagina == "Cadastro" ? "Confirmar Senha" : "Confirmar Nova Senha" }}:</label>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text {{ session("tema") == "escuro" ? "cor_fontes_escuro bg-light border-primary" : "cor_fontes_claro bg-dark border-danger" }}">***</span>
                                    <input type="password" id="confirmar_nova_senha" class="form-control cursor {{ session("tema") == "escuro" ? "bg-light border-primary text-black" : "bg-dark border-danger text-white" }}" name="confirmar_nova_senha" placeholder="..." aria-label="..." aria-describedby="ConfirmarNovaSenha" value="{{ old("confirmar_nova_senha", $values[3]) }}">
                                    <button type="button" id="mostrar_confirmar_novo" class="cursor input-group-text {{ session("tema") == "escuro" ? "cor_fontes_escuro bg-light border-primary" : "cor_fontes_claro bg-dark border-danger" }}"><i class="cursor bi bi-eye-slash-fill"></i></button>
                                </div>

                                @error("confirmar_nova_senha")
                                    <div class="alert alert-danger animate__animated animate__shakeX mt-1 mb-0" role="alert">
                                        <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                    </div>
                                @enderror
                                @error("senhas")
                                    <div class="alert alert-danger animate__animated animate__shakeX mt-1 mb-0" role="alert">
                                        <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="overflow-x-auto">
                                @if($pagina != "Atualização")
                                    <div class="d-flex gap-3">
                                        <div class="border-end {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} mb-3 pe-3">
                                            <label class="form-label {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}">Gênero:</label>
                                            <div class="d-flex mb-3">
                                                <div>
                                                    <div class="input-group">
                                                        <span class="input-group-text {{ session("tema") == "escuro" ? "cor_fontes_escuro bg-light border-primary" : "cor_fontes_claro bg-dark border-danger" }}"><i class="bi bi-sort-down"></i></span>
                                                        <select id="genero" class="form-select cursor {{ session("tema") == "escuro" ? "bg-light border-primary text-black" : "bg-dark border-danger text-white" }}" name="genero" aria-label="Generos">
                                                            <option selected>Selecione seu gênero...</option>
                                                            <option value="Masculino" {{ old("genero") == "Masculino" ? "selected" : "" }}>♂️ Masculino</option>
                                                            <option value="Feminino" {{ old("genero") == "Feminino" ? "selected" : "" }}>♀️ Feminino</option>
                                                            <option value="Outro" {{ old("genero") == "Outro" ? "selected" : "" }}>⚧ Outro</option>
                                                        </select>
                                                    </div>

                                                    @error("genero")
                                                        <div class="alert alert-danger animate__animated animate__shakeX mt-1 mb-0" role="alert">
                                                            <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="w-50">
                                            <label class="form-label {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}">País:</label>
                                            <div class="mb-3">
                                                <div class="input-group">
                                                    <span class="input-group-text {{ session("tema") == "escuro" ? "cor_fontes_escuro bg-light border-primary" : "cor_fontes_claro bg-dark border-danger" }}">
                                                        <i class="bi bi-flag-fill"></i>
                                                    </span>

                                                    <div id="countrySelect" class="form-control cursor p-0 {{ session("tema") == "escuro" ? "bg-light border-primary text-black" : "bg-dark border-danger text-white" }}">
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

                                                        <div id="paises" class="options border-top {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} rounded mt-1">
                                                            @foreach($paises as $codigo => $nome)
                                                                <div class="cursor option d-flex border-bottom {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} align-items-center gap-2 p-1" data-value="{{ $codigo }}">
                                                                    <span class="fi fi-{{ strtolower($codigo) }} ms-1"></span> 
                                                                    {{ $nome }}
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                        <input type="hidden" name="pais" id="pais" value="{{ $pais_antigo }}">
                                                    </div>
                                                </div>

                                                @error("pais")
                                                    <div class="alert alert-danger animate__animated animate__shakeX mt-1 mb-0" role="alert">
                                                        <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endif
        
                                <div class="d-flex gap-3 mb-3">
                                    <div class="d-flex gap-3">
                                        <div>
                                            <label class="form-label {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}">{{ $pagina == "Cadastro" ? "Classe" : "Nova Classe" }}:</label>
                                            <div class="input-group">
                                                <span class="input-group-text {{ session("tema") == "escuro" ? "cor_fontes_escuro bg-light border-primary" : "cor_fontes_claro bg-dark border-danger" }}"><i class="bi bi-sort-down"></i></span>
                                                <select id="classe" class="form-select cursor {{ session("tema") == "escuro" ? "bg-light border-primary text-black" : "bg-dark border-danger text-white" }}" name="classe" aria-label="Classes">
                                                    <option selected>Selecione sua classe...</option>
                                                    @foreach ($personagens as $personagem)
                                                        <option value="{{ $personagem->classe }}" {{ old("classe", $values[4]) == "$personagem->classe" ? "selected" : "" }}>
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
                                                <div class="alert alert-danger animate__animated animate__shakeX mt-1" role="alert">
                                                    <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="border-end {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} pe-3">
                                            <label class="form-label {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}"><i class="bi bi-person-circle"></i> Personagem:</label>
                                            <div>
                                                <img src="{{ asset('assets/images/perfils/' . $classe . '_perfil.png') }}" class="
                                                    @if($pagina == "Atualização")
                                                        @if($classe == "Guerreiro")
                                                            bg-danger border-danger
                                                        @elseif($classe == "Mago")
                                                            bg-primary border-primary
                                                        @elseif($classe == "Assassino")
                                                            bg-dark border-dark
                                                        @endif
                                                    @endif
                                                    perfil_cadastro border border-3 rounded-circle
                                                ">
                                            </div>
                                        </div>

                                        <div>
                                            <label class="form-label {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}">{{ $pagina == "Cadastro" ? "Foto (Opcional)" : "Nova Foto (Opcional)" }}:</label>
                                            <div class="d-grid">
                                                <div class="input-group">
                                                    <span class="input-group-text {{ session("tema") == "escuro" ? "cor_fontes_escuro bg-light border-primary" : "cor_fontes_claro bg-dark border-danger" }}"><i class="bi bi-file-earmark-person-fill"></i></span>
                                                    <input id="foto" class="form-control cursor {{ session("tema") == "escuro" ? "bg-light border border-primary text-black" : "bg-dark border border-danger text-white" }}" type="file" name="foto" accept="image/png, image/jpeg">
                                                </div>                                                
                                                @if($pagina == "Atualização")
                                                    <div class="form-check mt-2">
                                                        <input class="form-check-input cursor {{ session("tema") == "escuro" ? "border-primary focus-ring focus-ring-primary" : "border-danger focus-ring focus-ring-danger" }}" type="checkbox" name="sem_foto" value="nenhuma" id="sem_foto">
                                                        <label class="form-check-label" for="semFoto">
                                                            <span class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}">Sem Foto</span>
                                                        </label>
                                                    </div>
                                                @endif
                                            </div>

                                            @error("fotoTamanho")
                                                <div class="alert alert-danger animate__animated animate__shakeX mt-1" role="alert">
                                                    <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                                </div>
                                            @enderror
                                            @error("fotoErro")
                                                <div class="alert alert-danger animate__animated animate__shakeX mt-1" role="alert">
                                                    <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="form-label {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}"><i class="bi bi-person-bounding-box"></i> Perfil:</label>
                                            @php
                                                
                                                $foto = asset("assets/images/perfils/vazio_perfil.png");

                                                if ($pagina == "Atualização") {
                                                    if ($dados["foto"] != "nenhuma") {
                                                        
                                                        $foto = "data:image/png;base64," . $dados["foto"];

                                                    }
                                                }
                                            @endphp
                                            <div>
                                                <img src="{{ $foto }}" alt="Foto Preview" id="foto_preview" class="perfil_cadastro border border-3 rounded-circle">
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                            </div>
    
                            @error("playerExiste")
                                <div class="d-flex justify-content-center">
                                    <div class="alert alert-danger animate__animated animate__shakeX text-center w-50" role="alert">
                                        <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                    </div>
                                </div>
                            @enderror
                        </div>

                        <div class="card-footer border border-2 {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} d-flex justify-content-center gap-3 text-center py-3">
                            <button type="submit" class="cursor sombras botoes btn {{ session("tema") == "escuro" ? "btn-light border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }}">
                                <span class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}">
                                    @if ($pagina == "Cadastro")
                                        <i class="cursor bi bi-person-plus-fill"></i>
                                    @else
                                        <i class="cursor bi bi-save-fill"></i>
                                    @endif
                                    {{ $pagina == "Cadastro" ? "Cadastrar" : "Atualizar" }}
                                </span>
                            </button>
                            <button type="button" class="cursor sombras botoes btn {{ session("tema") == "escuro" ? "btn-light border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }}" onclick="limparCamposCadastro()"><span class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}"><i class="cursor bi bi-x-circle-fill"></i> Limpar</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection