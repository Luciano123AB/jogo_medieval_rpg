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
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix("/")->group(function () {
    Route::get("mudar-tema", [Temas::class, "mudarTema"])->name("tema");

    Route::controller(MainController::class)->group(function() {
        Route::middleware(VerificarBatalha::class)->group(function() {
            Route::get("", "home")->name("home");

            Route::get("regras", "regras")->name("regras");
            
            Route::get("sobre-classes", "sobreClasses")->name("sobre");

            Route::get("creditos", "creditos")->name("creditos");

            Route::get("cadastro", "cadastro")
                ->name("cadastro")
                ->middleware(VerificarDeslogado::class);

            Route::middleware(VerificarLogado::class)->group(function() {
                Route::get("atualizacao", "atualizacao")->name("atualizacao");
                Route::get("atualizacao-senha", "atualizacaoSenha")->name("atualizacao.senha");

                Route::get("totais-players", "totaisPlayers")->name("totais");

                Route::get("registro-batalhas", "registroBatalhas")->name("registro");

                Route::get("batalhas-andamento", "batalhasAndamento")->name("batalhas");

                Route::get("nivel-up", function(): RedirectResponse {
                    session()->flash(
                        "alerta_nivel", [
                            "titulo" => "Nível: " . Auth::user()->nivel,
                            "texto" => "Parabéns!, você acaba de subir de nível."
                        ]
                    );
                    session()->flash("level_up", true);

                    return redirect()->route("home");
                })->name("nivel");
            });
        });

        Route::middleware(VerificarLogado::class)->group(function() {
            Route::middleware(VerificarBatalha::class)->group(function() {
                Route::get("listagem", "listagem")->name("listagem");
    
                Route::get("preparacao", "preparacao")->name("preparacao");
            });
            
            Route::get("batalha", "batalhar")
                ->name("batalhar")
                ->middleware(VerificarVencedor::class);
            Route::post("batalha/iniciar", [Batalhar::class, "iniciarBatalha"])->name("batalhar.iniciar");
        });
    });

    Route::controller(Cadastrar::class)->group(function() {    
        Route::middleware(VerificarDeslogado::class)->group(function() {
            Route::post("confirmar-cadastrar", "confirmarCadastrar")->name("confirmar.cadastrar");
            Route::post("cadastro-submit", "cadastroSubmit")->name("cadastrar");
        });
    });

    Route::controller(LogarSair::class)->group(function() {
        Route::post("logar", "logar")->name("logar")->middleware(VerificarDeslogado::class);

        Route::middleware([VerificarLogado::class, VerificarBatalha::class])->group(function() {
            Route::post("confirmar-sair", "confirmarSair")->name("confirmar.sair");
            Route::post("sair", "sair")->name("sair");
        });
    });

    Route::controller(EditarDeletar::class)->group(function() {
        Route::middleware([VerificarLogado::class, VerificarBatalha::class])->group(function() {
            Route::post("confirmar-atualizar", "confirmarAtualizar")->name("confirmar.atualizar");
            Route::put("atualizar", "atualizar")->name("atualizar");

            Route::post("confirmar-senha", "confirmarSenha")->name("confirmar.senha");
            Route::put("atualizar-senha", "atualizarSenha")->name("atualizar.senha");

            Route::post("confirmar-deletar", "confirmarDeletar")->name("confirmar.deletar");
            Route::delete("deletar", "deletar")->name("deletar");
        });
    });

    Route::controller(Batalhar::class)->group(function() {
        Route::middleware(VerificarLogado::class)->group(function() {
            Route::middleware(VerificarBatalha::class)->group(function() {
                Route::post("confirmar-batalha", "confirmarBatalha")->name("confirmar.batalha");
                Route::post("confirmar-desafio/{id}", "confirmarDesafio")->name("confirmar.desafio");
            });
            
            Route::middleware(VerificarBatalhando::class)->group(function() {
                Route::post("atacar", "atacar")->name("atacar");
                Route::post("ataque-oponente/{id}", "ataqueOponente")->name("ataque");

                Route::post("atualizar-tempo", [Batalhar::class, "atualizarTempo"]);

                Route::post("confirmar-render", "confirmarRender")->name("confirmar.render");
                Route::post("render-se", "renderSe")->name("renderSe");
            });

            Route::controller(FinalizarBatalha::class)->group(function() {
                Route::post("finalizar-vitoria/{batalha}", "finalizarVitoria")->name("vitoria");
                Route::post("finalizar-derrota/{batalha}", "finalizarDerrota")->name("derrota");
            });
        });
    });

    Route::prefix("resetar")->group(function () {
        Route::controller(Resetar::class)->group(function() {
            Route::middleware(VerificarLogado::class)->group(function() {
                Route::delete("vitorias", "resetarVitorias")->name("resetar.vitorias");
                Route::delete("derrotas", "resetarDerrotas")->name("resetar.derrotas");
                Route::delete("batalha/{id}", "excluir")->name("excluir");
            });
        });
    });

    Route::fallback(function(): RedirectResponse {
        return redirect()->route("home");
    });
});
