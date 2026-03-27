<?php

use App\Http\Controllers\Temas;
use App\Http\Controllers\Cadastrar;
use App\Http\Controllers\EditarDeletar;
use App\Http\Controllers\LogarSair;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Batalhar;
use App\Http\Controllers\FinalizarBatalha;
use App\Http\Controllers\Resetar;
use App\Http\Middleware\VerificarBatalha;
use App\Http\Middleware\VerificarBatalhando;
use App\Http\Middleware\VerificarDeslogado;
use App\Http\Middleware\VerificarLogado;
use App\Http\Middleware\VerificarVencedor;
use App\Services\Boot;
use App\Services\SelecionarTemas;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix("/")->group(function () {
    Route::controller(Temas::class)->group(function() {
        Route::get("mudar_tema", "mudarTema")->name("tema");
    });

    Route::controller(MainController::class)->group(function() {
        Route::middleware(VerificarBatalha::class)->group(function() {
            Route::get("", function(): View {
                if (Boot::testarConexao() == false) {
                    Boot::criarPovoarBanco();
                }

                if (!is_dir(base_path("node_modules"))) {
                    Boot::dependencias();
                }
                
                session([
                    "alerta" => [
                        "titulo" => "Seja Muito Bem Vindo!",
                        "icone" => "bi-house-fill",
                        "texto" => "Faça seu cadastro caso ainda não tenha feito e divirta-se.",
                        "pagina" => "home"
                    ],
                ]);

                $pagina = "Home";
                $temas_selecionados = SelecionarTemas::temas($pagina);
                
                return view("index")
                    ->with("imagem", "estrada")
                    ->with("pagina", $pagina)
                    ->with("icone_pagina", "house-fill")
                    ->with("temas", $temas_selecionados);
            })->name("home");

            Route::get("regras", "regras")->name("regras");
            
            Route::get("sobre_classes", "sobreClasses")->name("sobre");

            Route::get("creditos", "creditos")->name("creditos");

            Route::get("cadastro", "cadastro")->name("cadastro")->middleware(VerificarDeslogado::class);

            Route::middleware(VerificarLogado::class)->group(function() {
                Route::get("atualizacao", "atualizacao")->name("atualizacao");

                Route::get("totais_players", "totaisPlayers")->name("totais");

                Route::get("registro_batalhas", "registroBatalhas")->name("registro");

                Route::get("batalhas_andamento", "batalhasAndamento")->name("batalhas");

                Route::get("nivel_up", function(): RedirectResponse {
                    session()->flash(
                        "alerta_nivel", [
                            "titulo" => "Nível: " . Auth::user()->nivel,
                            "texto" => "Parabéns!, você acaba de subir de nível."
                        ]
                    );

                    return redirect()->route("home");
                })->name("nivel");
            });
        });

        Route::middleware(VerificarLogado::class)->group(function() {
            Route::middleware(VerificarBatalha::class)->group(function() {
                Route::get("listagem", "listagem")->name("listagem");
    
                Route::get("preparacao", "preparacao")->name("preparacao");
            });
            
            Route::match(["GET", "POST"], "batalha", "batalhar")->name("batalhar")->middleware(VerificarVencedor::class);
        });
    });

    Route::controller(Cadastrar::class)->group(function() {    
        Route::middleware(VerificarDeslogado::class)->group(function() {
            Route::post("confirmar_cadastrar", "confirmarCadastrar")->name("confirmarCadastrar");
            Route::post("cadastro_submit", "cadastroSubmit")->name("cadastrar");
        });
    });

    Route::controller(LogarSair::class)->group(function() {
        Route::post("logar", "logar")->name("logar")->middleware(VerificarDeslogado::class);

        Route::middleware([VerificarLogado::class, VerificarBatalha::class])->group(function() {
            Route::post("confirmar_sair", "confirmarSair")->name("confirmarSair");
            Route::post("sair", "sair")->name("sair");
        });
    });

    Route::controller(EditarDeletar::class)->group(function() {
        Route::middleware([VerificarLogado::class, VerificarBatalha::class])->group(function() {
            Route::post("confirmar_atualizar", "confirmarAtualizar")->name("confirmarAtualizar");
            Route::put("atualizar", "atualizar")->name("atualizar");

            Route::post("confirmar_deletar", "confirmarDeletar")->name("confirmarDeletar");
            Route::delete("deletar", "deletar")->name("deletar");
        });
    });

    Route::controller(Batalhar::class)->group(function() {
        Route::middleware(VerificarLogado::class)->group(function() {
            Route::middleware(VerificarBatalha::class)->group(function() {
                Route::post("confirmar_batalha", "confirmarBatalha")->name("confirmarBatalha");
                Route::post("confirmar_desafio/{id}", "confirmarDesafio")->name("confirmarDesafio");
            });
            
            Route::middleware(VerificarBatalhando::class)->group(function() {
                Route::post("atacar", "atacar")->name("atacar");
                Route::post("ataque_oponente", "ataqueOponente")->name("ataque");

                Route::post("atualizar_tempo", [Batalhar::class, "atualizarTempo"]);

                Route::post("confirmar_render", "confirmarRender")->name("confirmarRender");
                Route::post("render_se", "renderSe")->name("renderSe");
            });

            Route::controller(FinalizarBatalha::class)->group(function() {
                Route::post("finalizar_vitoria/{batalha}", "finalizarVitoria")->name("vitoria");
                Route::post("finalizar_derrota/{batalha}", "finalizarDerrota")->name("derrota");
            });
        });
    });

    Route::prefix("resetar")->group(function () {
        Route::controller(Resetar::class)->group(function() {
            Route::middleware(VerificarLogado::class)->group(function() {
                Route::delete("vitorias", "resetarVitorias")->name("resetarVitorias");
                Route::delete("derrotas", "resetarDerrotas")->name("resetarDerrotas");
                Route::delete("batalha/{id}", "excluir")->name("excluir");
            });
        });
    });

    Route::fallback(function(): RedirectResponse {
        return redirect()->route("home");
    });
});
