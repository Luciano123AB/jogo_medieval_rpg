@extends("layouts.main_layout")

@section("content")
    <div class="container">
        <div class="fundos_card_{{ $temas[4] }} card p-3">
            <div class="d-grid gap-3 w-100">
                <div class="sombras animate__animated animate__zoomInLeft card bg-{{ $temas[0] }} border-{{ $temas[1] }} p-3">
                    <form action="{{ route("confirmar.senha") }}" method="POST" novalidate>
                        @csrf

                        <input type="hidden" name="id" value="{{ auth()->user()->id }}">

                        <div class="card-header border border-2 border-{{ $temas[1] }} text-center rounded-top">
                            <i class="bi bi-arrow-repeat titulos_{{ $temas[4] }} cor_fontes_{{ $temas[4] }} fs-5"></i>
                            <Label class="titulos_{{ $temas[4] }} cor_fontes_{{ $temas[4] }} fw-bold fs-5">Atualizar Senha</Label>
                        </div>

                        <div class="card-body border-start border-2 border-end border-{{ $temas[1] }}">
                            <label class="form-label cor_fontes_{{ $temas[4] }}">Senha Atual:</label>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text cor_fontes_{{ $temas[4] }} bg-{{ $temas[2] }} border-{{ $temas[1] }}">***</span>
                                    <input type="password" id="senha_atual" class="form-control cursor bg-{{ $temas[2] }} border-{{ $temas[1] }} focus-ring focus-ring-{{ $temas[1] }} text-{{ $temas[3] }}" name="senha_atual" placeholder="..." aria-label="..." aria-describedby="SenhaAtual" value="{{ old("senha_atual") }}">
                                    <button type="button" id="mostrar_atual" class="cursor input-group-text cor_fontes_{{ $temas[4] }} bg-{{ $temas[2] }} border-{{ $temas[1] }}">
                                        <i class="cursor bi bi-eye-slash-fill"></i>
                                    </button>
                                </div>
                                @error("senha_atual")
                                    <div class="alert alert-danger animate__animated animate__shakeX bg-danger mt-1 mb-0" role="alert">
                                        <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                    </div>
                                @enderror
                                @error("senha_invalida")
                                    <div class="alert alert-danger animate__animated animate__shakeX bg-danger mt-1 mb-0" role="alert">
                                        <i class="bi bi-info-circle-fill me-3"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <label class="form-label cor_fontes_{{ $temas[4] }}">Nova Senha:</label>
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
                            </div>

                            <label class="form-label cor_fontes_{{ $temas[4] }}">Confirmar Nova Senha:</label>
                            <div>
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
                            </div>
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