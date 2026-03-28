<?php

namespace App\Http\Controllers;

use App\Models\Batalha;
use App\Models\Desafio;
use App\Models\Personagem;
use App\Models\Player;
use App\Models\Regra;
use App\Services\Boot;
use App\Services\Paises;
use App\Services\PlayersPais;
use App\Services\Salvar;
use App\Services\SelecionarTemas;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function home(): View {
        if (Boot::testarConexao() == false) {
            Boot::criarPovoarBanco();
        }

        if (!is_dir(base_path("node_modules"))) {
            Boot::dependencias();
        }
        
        $this->alerta("Seja Muito Bem Vindo!", "bi-house-fill", "Faça seu cadastro caso ainda não tenha feito e divirta-se.", "home");

        $pagina = "Home";
        $temas_selecionados = SelecionarTemas::temas($pagina);
        
        return view("index")
            ->with("imagem", "estrada")
            ->with("pagina", $pagina)
            ->with("icone_pagina", "house-fill")
            ->with("temas", $temas_selecionados);
    }

    public function regras(): View {
        $this->alerta("Regras do Jogo!", "bi-question-circle-fill", "Aqui você entenderá como o jogo funciona, tanto suas regras quanto funcionalidades.", "regras");

        $pagina = "Regras";
        $temas = SelecionarTemas::temas($pagina);

        return view("regras")
            ->with("imagem", "campo_treinamento")
            ->with("pagina", $pagina)
            ->with("icone_pagina", "question-circle-fill")
            ->with("regras", Regra::all())
            ->with("temas", $temas);
    }

    public function sobreClasses(): View {
        $this->alerta("Descrição das Classes!", "bi-person-lines-fill", "Aqui você leiará tudo sobre cada classe existente.", "sobre");

        $pagina = "Descrições";
        $temas = SelecionarTemas::temas($pagina);

        return view("sobre_classes")
            ->with("imagem", "estatuas_classes")
            ->with("pagina", $pagina)
            ->with("icone_pagina", "person-lines-fill")
            ->with("personagens", Personagem::all())
            ->with("temas", $temas);
    }

    public function cadastro(): View {
        $this->alerta("Cadastro de Player!", "bi-person-fill-add", "Aqui você criará sua conta e escolherá sua classe preferencial.", "cadastro");

        $pagina = "Cadastro";
        $temas = SelecionarTemas::temas($pagina);

        return view("cadastro_atualizacao")
            ->with("imagem", "recrutamento")
            ->with("pagina", $pagina)
            ->with("icone_pagina", "person-fill-add")
            ->with("paises", Paises::paises())
            ->with("personagens", Personagem::all())
            ->with("temas", $temas);
    }

    public function atualizacao(): View {
        $this->alerta("Atualização de Player!", "bi-person-fill-down", "Aqui você editará os dados da sua conta e escolherá sua nova classe preferencial.", "atualizacao");

        $pagina = "Atualização";
        $temas = SelecionarTemas::temas($pagina);

        return view("cadastro_atualizacao")
            ->with("imagem", "recrutamento")
            ->with("pagina", $pagina)
            ->with("icone_pagina", "person-fill-add")
            ->with("paises", Paises::paises())
            ->with("personagens", Personagem::all())
            ->with("temas", $temas)
            ->with([
                "dados" => [
                    "id" => Auth::user()->id,
                    "usuario" => Auth::user()->usuario,
                    "email" => Auth::user()->email,
                    "classe" => Auth::user()->personagem->classe,
                    "foto" => Auth::user()->foto
                ]
            ]);
    }

    public function listagem(): View {
        $this->alerta("Lista de Players!", "bi-list-stars", "Aqui você vizualizará todos os players existentes e quem está na liderança, e caso queira, poderá desafiá-los para uma batalha, mas só poderá fazer isso 1 vez por dia.", "listagem");

        $pagina = "Listagem";
        $temas = SelecionarTemas::temas($pagina);

        return view("listagens/players")
            ->with("imagem", "recrutamento")
            ->with("pagina", $pagina)
            ->with("icone_pagina", "list-stars")
            ->with("players", Player::orderBy("usuario", "asc")
                            ->get()
                            ->map(function ($player) {
                                $player->id_crypt = Crypt::encrypt($player->id);

                                return $player;
                            }))
            ->with("player_lider_vitorias", Player::orderBy("quantidade_vitorias", "desc")->first())
            ->with("player_lider_nivel", Player::orderBy("nivel", "desc")->first())
            ->with("desafiou", Desafio::where("desafiador_id", Auth::user()->id)->pluck("desafiado_id")->toArray())
            ->with("temas", $temas);
    }

    public function totaisPlayers(): View {
        $this->alerta("Totais de Players!", "bi-flag-fill", "Aqui você descobrirá quantos players de cada país estão presentes no jogo.", "totais");

        foreach (Paises::paises() as $codigo => $nome) {
            $totais[$codigo] = [
                "nome"  => $nome,
                "total" => PlayersPais::playersPais()[$codigo] ?? 0
            ];
        }

        $pagina = "Totais";
        $temas = SelecionarTemas::temas($pagina);

        return view("listagens/totais_players")
            ->with("imagem", "recrutamento")
            ->with("pagina", $pagina)
            ->with("icone_pagina", "flag-fill")
            ->with("totais", $totais)
            ->with("temas", $temas);
    }

    public function registroBatalhas(): View {
        $this->alerta("Registro de Batalhas!", "bi-file-earmark-medical-fill", "Aqui você relembrará todas as suas vitórias e derrotas, e caso queira, poderá apagar esses registros.", "registro");

        $pagina = "Registro";
        $temas = SelecionarTemas::temas($pagina);

        return view("listagens/registro_batalhas")
            ->with("imagem", "registros")
            ->with("pagina", $pagina)
            ->with("icone_pagina", "file-earmark-medical-fill")
            ->with("batalhas_vitorias", Batalha::onlyTrashed()->where("ganhou", Auth::user()->usuario)
                                                ->get()
                                                ->map(function ($vitoria) {
                                                    $vitoria->id_crypt = Crypt::encrypt($vitoria->id);

                                                    return $vitoria;
                                                }))
            ->with("batalhas_derrotas", Batalha::onlyTrashed()->where("perdeu", Auth::user()->usuario)
                                                ->get()
                                                ->map(function ($derrota) {
                                                    $derrota->id_crypt = Crypt::encrypt($derrota->id);

                                                    return $derrota;
                                                }))
            ->with("temas", $temas);
    }

    public function batalhasAndamento(): View {
        $this->alerta("Batalhas em Andamento!", "bi-card-list", "Aqui você vizualizará todas as batalhas que estão acontecendo agora.", "batalhas");

        $pagina = "Batalhas";
        $temas = SelecionarTemas::temas($pagina);

        return view("listagens/batalhas")
            ->with("imagem", "registros")
            ->with("pagina", $pagina)
            ->with("icone_pagina", "card-list")
            ->with("batalhas", Batalha::where("deleted_at", null)->get())
            ->with("temas", $temas);
    }

    public function preparacao(): View | RedirectResponse {

        $nivel = Player::find(Auth::user()->id)->nivel;

        if (!$nivel) {
            $this->alertaResultado("Erro ao Carregar!", "Ocorreu um erro ao tentar abrir a página de preparação! Tente novamente.", "bi-hand-thumbs-down-fill");

            return redirect()->route("home");
        }

        $this->alerta("Preparação Antes da Batalha!", "⚔️", "Aqui você escolherá quem irá enfrentar usando sua classe.", "preparacao");

        $pagina = "Preparação";
        $temas = SelecionarTemas::temas($pagina);

        return view("preparacao")
            ->with("imagem", "coliseu")
            ->with("pagina", $pagina)
            ->with("icone_pagina", "⚔️")
            ->with("personagens", Personagem::all())
            ->with("classe", Auth::user()->personagem->classe)
            ->with("nivel", $nivel)
            ->with("temas", $temas);
    }

    public function batalhar(): View | RedirectResponse {
        $this->alerta("Batalha!", "bi-phone-landscape-fill", "Agora é a Hora! Aqui você aplicará o que aprendeu na página de regras, e recomendo que para essa página você vire a tela do seu dispositivo. Boa sorte!", "batalha");
        
        $nome_oponente = "Computador";
        $nivel = Auth::user()->nivel;

        if (session()->has("id_player")) {

            $dados_oponente = Player::find(session("id_player"));

            $oponente = Personagem::find($dados_oponente->personagem->id);
            $nome_oponente = $dados_oponente->usuario;
            $nivel = $dados_oponente->nivel;
        }
        
        if (!session()->has("batalha_comecou")) {
            
            $oponente = Personagem::find(session("id_oponente"));
            $nova_batalha = new Batalha();
            $batalha = $nova_batalha;

            if (!Salvar::batalharDesafiar($nova_batalha, $oponente, $nome_oponente, $nivel, random_int(0, 1), new Desafio())) {
                $this->alertaResultado("Erro ao Batalhar!", "Ocorreu um erro ao tentar começar a batalha! Tente novamente.", "bi-hand-thumbs-down-fill");

                return redirect()->route("preparacao");
            }

            session()->forget([
                "id_player",
                "id_oponente"
            ]);
            session([
                "id_batalha" => $nova_batalha->id,
                "batalha_comecou" => true
            ]);
        } else {

            $batalha = Batalha::find(session("id_batalha"));
            $oponente = Personagem::find($batalha->oponente_id);

            if ($batalha->inicio == false) {
                $batalha->inicio = true;
                $batalha->save();
            }
        }

        if (
            $batalha->skill01 == false &&
            $batalha->skill02 == false &&
            $batalha->skill03 == false
        ) {
            $batalha->skill01 = true;
            $batalha->skill02 = true;
            $batalha->skill03 = true;
            $batalha->save();
        }

        $pagina = "Batalha";
        $temas = SelecionarTemas::temas($pagina);

        return view("batalha")
            ->with("imagem", "coliseu")
            ->with("pagina", $pagina)
            ->with("icone_pagina", "⚔️")
            ->with("batalha", $batalha)
            ->with("vez", $batalha->vez)
            ->with("bandeira_oponente", $dados_oponente->pais ?? "")
            ->with("oponente", $oponente)
            ->with("foto", $dados_oponente->foto ?? "fotos/vazio.png")
            ->with("nome", $nome_oponente)
            ->with("temas", $temas);
    }

    public function creditos(): View {
        $this->alerta("Créditos do Jogo!", "bi-body-text", "Aqui você verá a lista de todos os desenvolvedores envolvidos.", "creditos");

        $pagina = "Créditos";
        $temas = SelecionarTemas::temas($pagina);

        return view("creditos")
            ->with("imagem", "estrada")
            ->with("pagina", $pagina)
            ->with("icone_pagina", "body-text")
            ->with("temas", $temas);
    }
}