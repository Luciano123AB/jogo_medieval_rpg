<nav id="navbar" class="navbar navbar-expand-lg {{ session("tema") == "escuro" ? "bg-light border-primary" : "bg-black border-danger" }} border-5 rounded-bottom-5 mb-4">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center">
            <a href="{{ route("home") }}" id="home" class="cursor navbar-brand">
                <img src="{{ asset("assets/images/icones/icone.png") }}" id="icone" class="cursor animate__animated animate__flipOutY animate__infinite">
                <span class="cursor align-middle fs-3">🎮</span>
                <span class="cursor {{ session("tema") == "escuro" ? "titulos_escuro cor_fontes_escuro" : "titulos_claro cor_fontes_claro" }} fw-bold align-middle fs-3">Jogo Medieval RPG</span>
                <br class="d-sm-none">
                <span class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }} animate__animated animate__fadeIn align-middle fs-3">- 
                    @if ($pagina == "Home")
                        <i class="bi bi-house-fill"></i>
                    @elseif($pagina == "Créditos")
                        <i class="cursor bi bi-body-text"></i>
                    @elseif($pagina == "Descrições")
                        <i class="cursor bi bi-person-lines-fill"></i>
                    @elseif($pagina == "Regras")
                        <i class="cursor bi bi-question-circle-fill"></i>
                    @elseif($pagina == "Cadastro")
                        <i class="cursor bi bi-person-fill-add"></i>
                    @elseif($pagina == "Atualização")
                        <i class="cursor bi bi-person-fill-down"></i>
                    @elseif($pagina == "Listagem")
                        <i class="bi bi-list-stars"></i>
                    @elseif($pagina == "Registro")
                        <i class="bi bi-file-earmark-medical-fill"></i>
                    @elseif($pagina == "Batalhas")
                        <i class="bi bi-card-list"></i>
                    @elseif($pagina == "Totais")
                        <i class="bi bi-flag-fill"></i>
                    @elseif($pagina == "Batalha" || $pagina == "Preparação")
                        ⚔️
                    @endif
                    {{ mb_strtoupper($pagina) }}
                </span>
            </a>

            @if($pagina != "Home" && $pagina != "Batalha")
                <div>
                    <a href="{{ route("home") }}" class="cursor sombras botoes animate__animated animate__fadeIn btn btn-lg {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} d-flex border my-1">
                        <span class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}"><i class="cursor bi bi-arrow-90deg-left animate__animated animate__fadeIn animate__infinite"></i> Voltar</span>
                    </a>
                </div>
            @endif
        </div>

        @if($pagina == "Batalha")
            <a href="{{ route("confirmarRender") }}" class="cursor sombras botoes animate__animated animate__fadeIn btn btn-lg {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} d-flex border my-1">
                <span class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}"><i class="cursor bi bi-arrow-90deg-left animate__animated animate__fadeIn animate__infinite"></i> Render-se</span>
            </a>
        @endif

        @if(session()->has("player") && $pagina != "Listagem" && $pagina != "Batalha")
            <a href="{{ route("listagem") }}" class="cursor sombras botoes animate__animated animate__fadeIn btn btn-lg {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} d-flex border my-1">
                <span class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}"><i class="cursor bi bi-list-stars"></i> Lista de Players/Rank</span>
            </a>
        @endif

        @if(session()->has("player") && $pagina != "Batalha")
            <div class="d-flex">
                <div class="input-group my-1">
                    <button class="cursor sombras animate__animated animate__fadeIn btn btn-lg {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} dropdown-toggle d-flex border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="d-grid">
                            <div class="cursor d-flex">
                                @php
                                    
                                    $perfil = asset("assets/images/perfils/" . (session("player.personagem.classe")) . "_perfil.png");
                                    $perfil_02 = asset("assets/images/perfils/vazio_perfil.png");

                                    if (session("player.foto") != "nenhuma") {
                                        $perfil = "data:image/png;data:image/jpeg;base64," . session("player.foto");
                                        $perfil_02 = asset("assets/images/perfils/" . (session("player.personagem.classe")) . "_perfil.png");
                                    }
                                @endphp
                                <div class="position-relative me-2">
                                    <img src="{{ $perfil }}" class="cursor sombras perfil_player border {{ session("tema") == "escuro" ? "border-primary" : "border-danger" }} rounded-circle">
                                    <img src="{{ $perfil_02 }}" class="position-absolute bottom-0 start-100 translate-middle cursor sombras perfil_players border {{ session("tema") == "escuro" ? "bg-light border-primary" : "bg-dark border-danger" }} rounded-circle">
                                </div>
                                <div class="cursor">
                                    <div class="border-3 border-start border-black rounded-top-1">
                                        <h4 class="cursor {{ session("tema") == "escuro" ? "titulos_escuro cor_fontes_escuro" : "titulos_claro cor_fontes_claro" }}"><i class="fi fi-{{ strtolower(session("player.pais")) }} animate__animated animate__jello animate__infinite border-start border-end mb-2 me-1"></i>{{ session("player.usuario") }}</h4>
                                    </div>
                                    <span class="cursor {{ session("tema") == "escuro" ? "text-bg-primary" : "text-bg-danger" }} {{ session("player.nivel") == 70 ? "text-warning" : "" }} badge">
                                        Nível: {{ session("player.nivel") }}
                                        @if(session("player.nivel") == 70)
                                            Max
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="cursor barras progress border {{ session("tema") == "escuro" ? "border-primary" : "border-success" }} bg-black" role="progressbar" aria-label="Animated striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                @php

                                    $nivel = "";

                                    if (session("player.nivel") == 70) {
                                        $nivel = "100.0";
                                    } else {
                                        $nivel = session("xp");
                                    }
                                @endphp
                                <div class="progress-bar progress-bar-striped progress-bar-animated {{ session("tema") == "escuro" ? "bg-primary" : "bg-success" }}" style="width: {{ $nivel }}%"><label class="cursor fw-bold fs-6">XP</label></div>
                            </div>
                        </div>
                    </button>
                    <ul class="dropdown-menu animate__animated animate__fadeInDown {{ session("tema") == "escuro" ? "bg-primary" : "bg-danger" }}">
                        @if($pagina != "Registro")
                            <li><a href="{{ route("registro") }}" class="dropdown-item {{ session("tema") == "escuro" ? "cor_fontes_escuro opcoes_player_escuro" : "cor_fontes_claro opcoes_player_claro" }} border-top border-black"><i class="bi bi-file-earmark-medical-fill"></i> Histórico</a></li>
                        @endif
                        @if($pagina != "Atualização")
                            <li><a href="{{ route("atualizacao") }}" class="dropdown-item {{ session("tema") == "escuro" ? "cor_fontes_escuro opcoes_player_escuro" : "cor_fontes_claro opcoes_player_claro" }} border-top border-black"><i class="bi bi-pen-fill"></i> Editar</a></li>
                        @endif
                        <li><a href="{{ route("confirmarDeletar") }}" class="dropdown-item {{ session("tema") == "escuro" ? "cor_fontes_escuro opcoes_player_escuro" : "cor_fontes_claro opcoes_player_claro" }} border-top border-black"><i class="bi bi-trash-fill"></i> Excluir Conta</a></li>
                        <li><a href="{{ route("confirmarSair") }}" class="dropdown-item {{ session("tema") == "escuro" ? "cor_fontes_escuro opcoes_player_escuro" : "cor_fontes_claro opcoes_player_claro" }} border-bottom border-top border-black"><i class="bi bi-box-arrow-left"></i> Sair</a></li>
                    </ul>
                </div>
            </div>
        @elseif($pagina != "Batalha")
            <div class="d-flex gap-3 my-1">
                @if($pagina != "Cadastro")
                    <a href="{{ route("cadastro") }}" class="cursor sombras botoes animate__animated animate__fadeIn btn btn-lg {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} d-flex border">
                        <span class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}"><i class="cursor bi bi-person-fill-add"></i> Cadastrar</span>
                    </a>
                @endif

                <div class="dropdown">
                    <button class="cursor sombras botoes animate__animated animate__fadeIn btn btn-lg {{ session("tema") == "escuro" ? "btn-secondary border-primary focus-ring focus-ring-primary" : "btn-dark border-danger focus-ring focus-ring-danger" }} dropdown-toggle d-flex border" type="button" data-bs-toggle="dropdown" aria-expanded="{{ $errors->any() ? 'true' : 'false' }}" data-bs-auto-close="false">
                        <span class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}"><i class="cursor bi bi-box-arrow-in-right animate__animated animate__fadeIn animate__infinite"></i> Logar</span>
                    </button>
                    <form action="{{ route("logar") }}" method="POST" id="login" class="sombras animate__animated animate__fadeInDown {{ session("tema") == "escuro" ? 'bg-secondary border-primary' : 'bg-black border-danger' }} dropdown-menu dropdown-menu-end p-3">
                        @csrf

                        <label class="form-label {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}">Email:</label>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text {{ session("tema") == "escuro" ? "cor_fontes_escuro bg-light border-primary" : "cor_fontes_claro bg-dark border-danger" }}"><i class="bi bi-envelope-at-fill"></i></span>
                                <input type="email" id="email" class="form-control cursor {{ session("tema") == "escuro" ? "bg-light border-primary text-black" : "bg-dark border-danger text-white" }}" name="email" placeholder="usuario@gmail.com" aria-label="usuario@gmail.com" aria-describedby="Email" value="{{ old("email") }}">
                            </div>
                            @error("email")
                                <div class="alert alert-danger animate__animated animate__shakeX mt-1 mb-0" role="alert">
                                    <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <label class="form-label {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}">Senha:</label>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text {{ session("tema") == "escuro" ? "cor_fontes_escuro bg-light border-primary" : "cor_fontes_claro bg-dark border-danger" }}">***</span>
                                <input type="password" id="senha" class="form-control cursor {{ session("tema") == "escuro" ? "bg-light border-primary text-black" : "bg-dark border-danger text-white" }}" name="senha" placeholder="..." aria-label="..." aria-describedby="Senha" value="{{ old("senha") }}">
                                <button type="button" id="mostrar" class="cursor input-group-text {{ session("tema") == "escuro" ? "cor_fontes_escuro bg-light border-primary" : "cor_fontes_claro bg-dark border-danger" }}"><i class="cursor bi bi-eye-slash-fill"></i></button>
                            </div>
                            @error("senha")
                                <div class="alert alert-danger animate__animated animate__shakeX mt-1 mb-0" role="alert">
                                    <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        @error("playerNaoExiste")
                            <div class="d-flex justify-content-center">
                                <div class="alert alert-danger animate__animated animate__shakeX text-center w-50" role="alert">
                                    <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                </div>
                            </div>
                        @enderror

                        <div class="d-flex justify-content-center gap-3 text-center">
                            <button type="submit" class="cursor sombras botoes animate__animated animate__fadeIn btn {{ session("tema") == "escuro" ? "btn-light border-primary" : "btn-dark border-danger" }}"><span class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}"><i class="cursor bi bi-door-open-fill"></i> Entrar</span></button>
                            <button type="button" class="cursor sombras botoes animate__animated animate__fadeIn btn {{ session("tema") == "escuro" ? "btn-light border-primary" : "btn-dark border-danger" }}" onclick="limparCamposLogin()"><span class="cursor {{ session("tema") == "escuro" ? "cor_fontes_escuro" : "cor_fontes_claro" }}"><i class="cursor bi bi-x-circle-fill"></i> Limpar</span></button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</nav>