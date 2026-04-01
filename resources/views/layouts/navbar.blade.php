@php

    $temas = ["light", "primary", "secondary", "secondary", "light", "black", "escuro"];
    
    if (session("tema") == "claro" || !session()->has("tema")) {
        $temas = ["black", "danger", "dark", "black", "dark", "white", "claro"];
    }
@endphp

<nav id="navbar" class="navbar navbar-expand-lg bg-{{ $temas[0] }} border-{{ $temas[1] }} border-5 rounded-bottom-5 mb-4">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center">
            <a href="{{ route("home") }}" id="home" class="cursor navbar-brand">
                <img src="{{ asset("assets/images/icones/icone.png") }}" id="icone" class="cursor animate__animated animate__flipOutY animate__infinite">
                <span class="cursor align-middle fs-3">🎮</span>
                <span class="cursor titulos_{{ $temas[6] }} cor_fontes_{{ $temas[6] }} fw-bold align-middle fs-3">{{ env("APP_NAME") }}</span>
                <br class="d-sm-none">
                <span class="cursor cor_fontes_{{ $temas[6] }} animate__animated animate__fadeIn align-middle fs-3">- 
                    @if ($icone_pagina != "⚔️")
                        <i class="bi bi-{{ $icone_pagina }}"></i>
                    @else
                        ⚔️
                    @endif
                    {{ mb_strtoupper($pagina) }}
                </span>
            </a>

            @if($pagina != "Home" && $pagina != "Batalha")
                <div>
                    <a href="{{ route("home") }}" class="cursor sombras botoes animate__animated animate__fadeIn btn btn-lg focus-ring btn-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} d-flex border my-1">
                        <span class="cursor cor_fontes_{{ $temas[6] }} d-flex justify-content-center">
                            <div class="cursor animate__animated animate__fadeOutLeft animate__infinite">
                                <i class="cursor bi bi-arrow-90deg-left"></i>
                            </div>
                            Voltar
                        </span>
                    </a>
                </div>
            @endif
        </div>

        @if($pagina == "Batalha")
            <form action="{{ route("confirmarRender") }}" method="POST">
                @csrf

                <button type="submit" class="cursor sombras botoes animate__animated animate__fadeIn btn btn-lg focus-ring btn-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} d-flex border my-1">
                    <span class="cursor cor_fontes_{{ $temas[6] }} d-flex justify-content-center">
                        <div class="cursor animate__animated animate__fadeOutLeft animate__infinite">
                            <i class="cursor bi bi-arrow-90deg-left"></i>
                        </div>
                        Render-se
                    </span>
                </button>
            </form>
        @endif

        @if(Auth::user() && $pagina != "Listagem" && $pagina != "Batalha")
            <a href="{{ route("listagem") }}" class="cursor sombras botoes animate__animated animate__fadeIn btn btn-lg focus-ring btn-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} d-flex border my-1">
                <span class="cursor cor_fontes_{{ $temas[6] }} d-flex justify-content-center">
                    <div class="cursor animate__animated animate__flipInX animate__infinite">
                        <i class="cursor bi bi-list-stars me-2"></i>
                    </div>
                    Lista de Players/Rank
                </span>
            </a>
        @endif

        @if(Auth::user() && $pagina != "Batalha")
            <div class="d-flex">
                <div class="input-group my-1">
                    <button class="cursor sombras animate__animated animate__fadeIn btn btn-lg focus-ring btn-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} dropdown-toggle d-flex border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="d-grid">
                            <div class="cursor d-flex">
                                @php
                                    
                                    $perfil = asset("assets/images/perfils/" . strtolower(Auth::user()->personagem->classe) . ".png");
                                    $perfil_02 = asset("photos/vazio.png");

                                    if (Auth::user()->foto != "photos/vazio.png") {
                                        $perfil = asset(Auth::user()->foto);
                                        $perfil_02 = asset("assets/images/perfils/" . strtolower(Auth::user()->personagem->classe) . ".png");
                                    }
                                @endphp
                                <div class="position-relative me-2">
                                    <img src="{{ $perfil }}" class="cursor sombras perfil_player border border-3 border-{{ $temas[1] }} rounded-circle">
                                    <img src="{{ $perfil_02 }}" class="position-absolute bottom-0 start-100 translate-middle cursor sombras perfil_players border bg-{{ $temas[0] }} border-{{ $temas[1] }} rounded-circle">
                                </div>
                                <div class="cursor">
                                    <div class="d-flex border-3 border-start border-black rounded-top-1">
                                        <h4 class="cursor titulos_{{ $temas[6] }} cor_fontes_{{ $temas[6] }}">
                                            <i class="fi fi-{{ strtolower(Auth::user()->pais) }} animate__animated animate__jello animate__infinite border-start border-end mb-2 me-2"></i>{{ Auth::user()->user }}
                                        </h4>
                                        <h4 class="cursor">
                                            {{ Auth::user()->online == true ? "🟢" : "🔴" }}
                                        </h4>
                                    </div>
                                    <span class="cursor text-bg-{{ $temas[1] }} {{ Auth::user()->nivel == 70 ? "text-warning" : "" }} badge">
                                        Nível: {{ Auth::user()->nivel }}
                                        @if(Auth::user()->nivel == 70)
                                            Max
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="cursor barras progress border border-success bg-black" role="progressbar" aria-label="Animated striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                @php
                                    if (Auth::user()->nivel == 70) {
                                        $nivel = "100.0";
                                    } else {
                                        $nivel = number_format(Auth::user()->xp / 10, "1", ".", "");
                                    }
                                @endphp
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: {{ $nivel }}%">
                                    <label class="cursor fw-bold fs-6">{{ Auth::user()->xp == 0 ? 1000 : Auth::user()->xp }} XP</label>
                                </div>
                            </div>
                        </div>
                    </button>
                    <ul class="dropdown-menu animate__animated animate__fadeInDown bg-{{ $temas[1] }}">
                        <li class="border border-1 border-black"></li>
                        @if($pagina != "Registro")
                            <li>
                                <a href="{{ route("registro") }}" class="dropdown-item cor_fontes_{{ $temas[6] }} opcoes_player_{{ $temas[6] }} border-top border-black">
                                    <i class="bi bi-file-earmark-medical-fill"></i>
                                    Histórico
                                </a>
                            </li>
                        @endif
                        @if($pagina != "Atualização")
                            <li>
                                <a href="{{ route("atualizacao") }}" class="dropdown-item cor_fontes_{{ $temas[6] }} opcoes_player_{{ $temas[6] }} border-top border-black">
                                    <i class="bi bi-pen-fill"></i>
                                    Editar
                                </a>
                            </li>
                        @endif
                        @if($pagina != "Atualização Senha")
                            <li>
                                <a href="{{ route("atualizacaoSenha") }}" class="dropdown-item cor_fontes_{{ $temas[6] }} opcoes_player_{{ $temas[6] }} border-top border-black">
                                    <i class="bi bi-key-fill"></i>
                                    Mudar Senha
                                </a>
                            </li>
                        @endif
                        <li>
                            <form action="{{ route("confirmarDeletar") }}" method="POST">
                                @csrf

                                <button type="submit" class="dropdown-item cor_fontes_{{ $temas[6] }} opcoes_player_{{ $temas[6] }} border-top border-black">
                                    <i class="bi bi-trash-fill"></i>
                                    Excluir Conta
                                </button>
                            </form>
                        </li>
                        <li>
                            <form action="{{ route("confirmarSair") }}" method="POST">
                                @csrf

                                <button type="submit" class="dropdown-item cor_fontes_{{ $temas[6] }} opcoes_player_{{ $temas[6] }} border-bottom border-top border-black">
                                    <i class="bi bi-power"></i>
                                    Sair
                                </button>
                            </form>
                        </li>
                        <li class="border border-1 border-black"></li>
                    </ul>
                </div>
            </div>
        @elseif($pagina != "Batalha")
            <div class="d-flex gap-3 my-1">
                @if($pagina != "Cadastro")
                    <a href="{{ route("cadastro") }}" class="cursor sombras botoes animate__animated animate__fadeIn btn btn-lg focus-ring btn-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} d-flex border">
                        <span class="cursor cor_fontes_{{ $temas[6] }} d-flex justify-content-center">
                            <div class="cursor animate__animated animate__heartBeat animate__infinite">
                                <i class="cursor bi bi-person-fill-add me-1"></i>
                            </div>
                            Cadastrar
                        </span>
                    </a>
                @endif

                <div class="dropdown">
                    <button class="cursor sombras botoes animate__animated animate__fadeIn btn btn-lg focus-ring btn-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring-{{ $temas[1] }} dropdown-toggle d-flex border" type="button" data-bs-toggle="dropdown" aria-expanded="{{ $errors->any() ? 'true' : 'false' }}" data-bs-auto-close="false">
                        <span class="cursor cor_fontes_{{ $temas[6] }}"><i class="cursor bi bi-box-arrow-in-right animate__animated animate__fadeIn animate__infinite"></i> Logar</span>
                    </button>
                    <form action="{{ route("logar") }}" method="POST" id="login" class="sombras animate__animated animate__fadeInDown bg-{{ $temas[3] }} border-{{ $temas[1] }} dropdown-menu {{ $pagina == "Cadastro" ? "dropdown-menu-lg-end" : "dropdown-menu-end" }} p-3">
                        @csrf

                        <label class="form-label cor_fontes_{{ $temas[6] }}">Email:</label>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text cor_fontes_{{ $temas[6] }} bg-{{ $temas[4] }} border-{{ $temas[1] }}">
                                    <i class="bi bi-envelope-at-fill"></i>
                                </span>
                                <input type="email" id="email" class="form-control cursor bg-{{ $temas[4] }} border-{{ $temas[1] }} focus-ring focus-ring-{{ $temas[1] }} text-{{ $temas[5] }}" name="email" placeholder="usuario@gmail.com" aria-label="usuario@gmail.com" aria-describedby="Email" value="{{ old("email") }}">
                            </div>
                            @error("email")
                                <div class="alert alert-danger animate__animated animate__shakeX bg-danger mt-1 mb-0" role="alert">
                                    <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <label class="form-label cor_fontes_{{ $temas[6] }}">Senha:</label>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text cor_fontes_{{ $temas[6] }} bg-{{ $temas[4] }} border-{{ $temas[1] }}">***</span>
                                <input type="password" id="senha" class="form-control cursor bg-{{ $temas[4] }} border-{{ $temas[1] }} focus-ring focus-ring-{{ $temas[1] }} text-{{ $temas[5] }}" name="senha" placeholder="..." aria-label="..." aria-describedby="Senha" value="{{ old("senha") }}">
                                <button type="button" id="mostrar" class="cursor input-group-text cor_fontes_{{ $temas[6] }} bg-{{ $temas[4] }} border-{{ $temas[1] }}">
                                    <i class="cursor bi bi-eye-slash-fill"></i>
                                </button>
                            </div>
                            @error("senha")
                                <div class="alert alert-danger animate__animated animate__shakeX bg-danger mt-1 mb-0" role="alert">
                                    <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        @error("playerNaoExiste")
                            <div class="alert alert-danger animate__animated animate__shakeX bg-danger" role="alert">
                                <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                            </div>
                        @enderror

                        <div class="d-flex justify-content-center gap-3 text-center">
                            <button type="submit" class="cursor sombras botoes animate__animated animate__fadeIn btn btn-{{ $temas[4] }} border-{{ $temas[1] }}" >
                                <span class="cursor cor_fontes_{{ $temas[6] }}">
                                    <i class="cursor bi bi-door-open-fill animate__animated animate__fadeIn animate__infinite"></i>
                                    Entrar
                                </span>
                            </button>
                            <button type="button" class="cursor sombras botoes animate__animated animate__fadeIn btn btn-{{ $temas[4] }} border-{{ $temas[1] }}" onclick="limparCamposLogin()">
                                <span class="cursor cor_fontes_{{ $temas[6] }} d-flex justify-content-center">
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
        @endif
    </div>
</nav>
