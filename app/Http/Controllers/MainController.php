<?php

namespace App\Http\Controllers;

use App\Models\Batalha;
use App\Models\Desafio;
use App\Models\Personagem;
use App\Models\Player;
use App\Models\Regra;
use App\Services\Paises;
use App\Services\PlayersPais;
use App\Services\Salvar;
use Illuminate\Contracts\View\View;

class MainController extends Controller
{
    public function regras(): View {
        $this->alerta("Regras do Jogo!", "bi-question-circle-fill", "Aqui você entenderá como o jogo funciona, tanto suas regras quanto funcionalidades.", "regras");

        $temas = ["secondary", "primary", "escuro"];
        
        if (session("tema") == "claro" || !session()->has("tema")) {
            $temas = ["dark", "danger", "claro"];
        }

        return view("regras")
            ->with("imagem", "campo_treinamento")
            ->with("pagina", "Regras")
            ->with("regras", Regra::all())
            ->with("temas", $temas);
    }

    public function sobreClasses(): View {
        $this->alerta("Descrição das Classes!", "bi-person-lines-fill", "Aqui você leiará tudo sobre cada classe existente.", "sobre");

        $temas = ["secondary", "primary", "escuro"];
        
        if (session("tema") == "claro" || !session()->has("tema")) {
            $temas = ["dark", "danger", "claro"];
        }

        return view("sobre_classes")
            ->with("imagem", "estatuas_classes")
            ->with("pagina", "Descrições")
            ->with("personagens", Personagem::all())
            ->with("temas", $temas);
    }

    public function creditos(): View {
        $this->alerta("Créditos do Jogo!", "bi-body-text", "Aqui você verá a lista de todos os desenvolvedores envolvidos.", "creditos");

        $temas = ["secondary", "primary", "escuro"];
        
        if (session("tema") == "claro" || !session()->has("tema")) {
            $temas = ["dark", "danger", "claro"];
        }

        return view("creditos")
            ->with("imagem", "estrada")
            ->with("pagina", "Créditos")
            ->with("temas", $temas);
    }

    public function cadastro(): View {
        $this->alerta("Cadastro de Player!", "bi-person-fill-add", "Aqui você criará sua conta e escolherá sua classe preferencial.", "cadastro");

        $temas = ["secondary", "primary", "light", "black", "escuro"];
        
        if (session("tema") == "claro" || !session()->has("tema")) {
            $temas = ["dark", "danger", "dark", "white", "claro"];
        }

        return view("cadastro_atualizacao")
            ->with("imagem", "recrutamento")
            ->with("pagina", "Cadastro")
            ->with("paises", Paises::paises())
            ->with("personagens", Personagem::all())
            ->with("temas", $temas);
    }

    public function atualizacao(): View {
        $this->alerta("Atualização de Player!", "bi-person-fill-down", "Aqui você editará os dados da sua conta e escolherá sua nova classe preferencial.", "atualizacao");

        $temas = ["secondary", "primary", "light", "black", "escuro"];
        
        if (session("tema") == "claro" || !session()->has("tema")) {
            $temas = ["dark", "danger", "dark", "white", "claro"];
        }

        return view("cadastro_atualizacao")
            ->with("imagem", "recrutamento")
            ->with("pagina", "Atualização")
            ->with("paises", Paises::paises())
            ->with("personagens", Personagem::all())
            ->with("temas", $temas)
            ->with([
                "dados" => [
                    "id" => session("player.id"),
                    "usuario" => session("player.usuario"),
                    "email" => session("player.email"),
                    "classe" => session("player.personagem.classe"),
                    "foto" => session("player.foto")
                ]
            ]);
    }

    public function listagem(): View {
        $this->alerta("Lista de Players!", "bi-list-stars", "Aqui você vizualizará todos os players existentes e quem está na liderança, e caso queira, poderá desafiá-los para uma batalha, mas só poderá fazer isso 1 vez por dia.", "listagem");

        $temas = ["secondary", "primary", "light", "escuro"];
        
        if (session("tema") == "claro" || !session()->has("tema")) {
            $temas = ["dark", "danger", "dark", "claro"];
        }

        return view("listagens/players")
            ->with("imagem", "recrutamento")
            ->with("pagina", "Listagem")
            ->with("players", Player::orderBy("usuario", "asc")->get())
            ->with("player_lider_vitorias", Player::orderBy("quantidade_vitorias", "desc")->first())
            ->with("player_lider_nivel", Player::orderBy("nivel", "desc")->first())
            ->with("desafiou", Desafio::where("id_desafiador", session("player.id"))->pluck("id_desafiado")->toArray())
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

        $temas = ["secondary", "primary", "escuro"];
        
        if (session("tema") == "claro" || !session()->has("tema")) {
            $temas = ["dark", "danger", "claro"];
        }

        return view("listagens/totais_players")
            ->with("imagem", "recrutamento")
            ->with("pagina", "Totais")
            ->with("totais", $totais)
            ->with("temas", $temas);
    }

    public function registroBatalhas(): View {
        $this->alerta("Registro de Batalhas!", "bi-file-earmark-medical-fill", "Aqui você relembrará todas as suas vitórias e derrotas, e caso queira, poderá apagar esses registros.", "registro");

        $temas = ["secondary", "primary", "light", "escuro"];
        
        if (session("tema") == "claro" || !session()->has("tema")) {
            $temas = ["dark", "danger", "dark", "claro"];
        }

        return view("listagens/registro_batalhas")
            ->with("imagem", "registros")
            ->with("pagina", "Registro")
            ->with("batalhas_vitorias", Batalha::onlyTrashed()->where("ganhou", session("player.usuario"))->get())
            ->with("batalhas_derrotas", Batalha::onlyTrashed()->where("perdeu", session("player.usuario"))->get())
            ->with("temas", $temas);
    }

    public function batalhasAndamento(): View {
        $this->alerta("Batalhas em Andamento!", "bi-card-list", "Aqui você vizualizará todas as batalhas que estão acontecendo agora.", "batalhas");

        $temas = ["secondary", "primary", "escuro"];
        
        if (session("tema") == "claro" || !session()->has("tema")) {
            $temas = ["dark", "danger", "claro"];
        }

        return view("listagens/batalhas")
            ->with("imagem", "registros")
            ->with("pagina", "Batalhas")
            ->with("batalhas", Batalha::where("deleted_at", null)->get())
            ->with("temas", $temas);
    }

    public function preparacao(): View {
        $this->alerta("Preparação Antes da Batalha!", "⚔️", "Aqui você escolherá quem irá enfrentar usando sua classe.", "preparacao");

        $temas = ["secondary", "primary", "cor_niveis", "light", "escuro"];
        
        if (session("tema") == "claro" || !session()->has("tema")) {
            $temas = ["dark", "danger", "text-danger", "dark", "claro"];
        }

        return view("preparacao")
            ->with("imagem", "coliseu")
            ->with("pagina", "Preparação")
            ->with("personagens", Personagem::all())
            ->with("classe", session("player.personagem.classe"))
            ->with("nivel", Player::findOrFail(session("player.id"))->nivel)
            ->with("temas", $temas);
    }

    public function batalhar(): View {
        $this->alerta("Batalha!", "bi-phone-landscape-fill", "Agora é a Hora! Aqui você aplicará o que aprendeu na página de regras, e recomendo que para essa página você vire a tela do seu dispositivo. Boa sorte!", "batalha");
        
        $oponente = Personagem::findOrFail(session("id_oponente"));
        $batalha = null;
        $nivel = null;

        if (session()->has("nivel_oponente")) {
            $nivel = session("nivel_oponente");
        } else {
            $nivel = session("player.nivel");
        }
        
        if (!session()->has("dados.batalha_comecou")) {
            
            $nova_batalha = new Batalha();

            Salvar::batalharDesafiar($nova_batalha, $oponente, $nivel, random_int(0, 1), new Desafio());

            $batalha = $nova_batalha;

            session([
                "dados" => [
                    "id_batalha" => $nova_batalha->id,
                    "id_oponente" => $oponente->id,
                    "hp_maximo" => session("player.personagem.hp") * session("player.nivel"),
                    "hp_oponente_maximo" => $oponente->hp * $nivel,
                    "batalha_comecou" => true
                ]
            ]);
        } else {
            $batalha = Batalha::findOrFail(session("dados.id_batalha"));
        }

        $temas = ["secondary", "primary", "escuro"];
        
        if (session("tema") == "claro" || !session()->has("tema")) {
            $temas = ["dark", "danger", "claro"];
        }

        return view("batalha")
            ->with("imagem", "coliseu")
            ->with("pagina", "Batalha")
            ->with("batalha", $batalha)
            ->with("vez", $batalha->vez)
            ->with("bandeira_oponente", session("pais_oponente"))
            ->with("oponente", $oponente)
            ->with("foto", session("foto_oponente"))
            ->with("nome", session("nome_oponente"))
            ->with("temas", $temas);
    }    
}