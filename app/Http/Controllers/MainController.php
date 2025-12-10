<?php

namespace App\Http\Controllers;

use App\Models\Batalha;
use App\Models\Desafio;
use App\Models\Personagem;
use App\Models\Player;
use App\Services\Paises;
use App\Services\PlayersPais;
use Illuminate\Contracts\View\View;

class MainController extends Controller
{
    public function regras(): View {
        session([
            "alerta" => [
                "titulo" => "Regras do Jogo!",
                "icone" => "bi-question-circle-fill",
                "texto" => "Aqui você entenderá como o jogo funciona.",
                "pagina" => "regras"
            ]
        ]);

        return view("regras")
            ->with("imagem", "campo_treinamento")
            ->with("pagina", "Regras");
    }

    public function sobreClasses(): View {

        $personagens = Personagem::all();

        session([
            "alerta" => [
                "titulo" => "Descrição das Classes!",
                "icone" => "bi-person-lines-fill",
                "texto" => "Aqui você vai entender como cada classe funciona.",
                "pagina" => "sobre"
            ]
        ]);

        return view("sobre_classes")
            ->with("imagem", "estatuas_classes")
            ->with("pagina", "Descrições")
            ->with("personagens", $personagens);
    }

    public function creditos(): View {
        session([
            "alerta" => [
                "titulo" => "Créditos do Jogo!",
                "icone" => "bi-body-text",
                "texto" => "Aqui você verá a lista de todos os desenvolvedores envolvidos.",
                "pagina" => "creditos"
            ]
        ]);

        return view("creditos")
            ->with("imagem", "estrada")
            ->with("pagina", "Créditos");
    }

    public function cadastro(): View {

        $personagens = Personagem::all();
        $paises = Paises::paises();

        session([
            "alerta" => [
                "titulo" => "Cadastro de Player!",
                "icone" => "bi-person-fill-add",
                "texto" => "Aqui você criará sua conta e escolherá sua classe preferencial.",
                "pagina" => "cadastro"
            ]
        ]);

        return view("cadastro_atualizacao", compact("paises"))
            ->with("imagem", "recrutamento")
            ->with("pagina", "Cadastro")
            ->with("personagens", $personagens);
    }

    public function atualizacao(): View {

        $personagens = Personagem::all();
        $id = session("player.id");
        $usuario = session("player.usuario");
        $email = session("player.email");
        $senha = decrypt(session("player.senha"));
        $classe = session("player.personagem.classe");
        $foto = session("player.foto");
        $paises = Paises::paises();

        session([
            "alerta" => [
                "titulo" => "Atualização de Player!",
                "icone" => "bi-person-fill-down",
                "texto" => "Aqui você editará os dados da sua conta e escolherá sua nova classe preferencial.",
                "pagina" => "atualizacao"
            ]
        ]);

        return view("cadastro_atualizacao", compact("paises"))
            ->with("imagem", "recrutamento")
            ->with("pagina", "Atualização")
            ->with("personagens", $personagens)
            ->with([
                "dados" => [
                    "id" => $id,
                    "usuario" => $usuario,
                    "email" => $email,
                    "senha" => $senha,
                    "confirmar_senha" => $senha,
                    "classe" => $classe,
                    "foto" => $foto
                ]
            ]);
    }

    public function listagem(): View {

        $players = Player::orderBy("usuario", "asc")->get();
        $player_lider_vitorias = Player::orderBy("quantidade_vitorias", "desc")->first();
        $player_lider_nivel = Player::orderBy("nivel", "desc")->first();
        $desafiou = Desafio::where("id_desafiador", session("player.id"))
                           ->pluck("id_desafiado")
                           ->toArray();

        session([
            "alerta" => [
                "titulo" => "Lista de Players!",
                "icone" => "bi-list-stars",
                "texto" => "Aqui você vizualizará todos os players existentes e quem está na liderança, e caso queira, poderá desafiá-los para uma batalha, mas só poderá fazer isso 1 vez por dia.",
                "pagina" => "listagem"
            ]
        ]);

        return view("listagens/players")
            ->with("imagem", "recrutamento")
            ->with("pagina", "Listagem")
            ->with("players", $players)
            ->with("player_lider_vitorias", $player_lider_vitorias)
            ->with("player_lider_nivel", $player_lider_nivel)
            ->with("desafiou", $desafiou);
    }

    public function totaisPlayers() {

        $paises = Paises::paises();
        $totais = [];
        
        foreach ($paises as $codigo => $nome) {
            $totais[$codigo] = [
                "nome" => $nome,
                "total" => PlayersPais::playersPais($codigo)
            ];
        }

        session([
            "alerta" => [
                "titulo" => "Totais de Players!",
                "icone" => "bi-flag-list",
                "texto" => "Aqui você descobri-rá quantos players de cada país estão presentes no jogo.",
                "pagina" => "totais"
            ]
        ]);

        return view("listagens/totais_players")
            ->with("imagem", "recrutamento")
            ->with("pagina", "Totais")
            ->with("totais", $totais);
    }

    public function registroBatalhas(): View {

        $batalhas_vitorias = Batalha::onlyTrashed()
                                    ->where("ganhou", session("player.usuario"))
                                    ->get();
        $batalhas_derrotas = Batalha::onlyTrashed()
                                    ->where("perdeu", session("player.usuario"))
                                    ->get();

        session([
            "alerta" => [
                "titulo" => "Registro de Batalhas!",
                "icone" => "bi-file-earmark-medical-fill",
                "texto" => "Aqui você irá relembrar todas as suas vitórias e derrotas, e caso queira, poderá apagar esses registros.",
                "pagina" => "registro"
            ]
        ]);

        return view("listagens/registro_batalhas")
            ->with("imagem", "registros")
            ->with("pagina", "Registro")
            ->with("batalhas_vitorias", $batalhas_vitorias)
            ->with("batalhas_derrotas", $batalhas_derrotas);
    }

    public function batalhasAndamento(): View {

        $batalhas = Batalha::where("deleted_at", null)->get();

        session([
            "alerta" => [
                "titulo" => "Batalhas em Andamento!",
                "icone" => "bi-card-list",
                "texto" => "Aqui você irá vizualizar todas as batalhas que estão acontecendo agora.",
                "pagina" => "batalhas"
            ]
        ]);

        return view("listagens/batalhas")
            ->with("imagem", "registros")
            ->with("pagina", "Batalhas")
            ->with("batalhas", $batalhas);
    }

    public function preparacao(): View {

        $id = session("player.id");
        $personagens = Personagem::all();
        $classe_player = session("player.personagem.classe");
        $nivel = Player::find($id);

        session([
            "alerta" => [
                "titulo" => "Preparação Antes da Batalha!",
                "icone" => "⚔️",
                "texto" => "Aqui você escolherá quem irá enfrentar usando sua classe.",
                "pagina" => "preparacao"
            ]
        ]);

        return view("preparacao")
            ->with("imagem", "coliseu")
            ->with("pagina", "Preparação")
            ->with("personagens", $personagens)
            ->with("classe", $classe_player)
            ->with("nivel", $nivel->nivel);
    }

    public function batalhar(): View {
        session()->forget("alerta_confirmar");

        $batalha = null;
        $id = session("id_oponente");
        $foto_oponente = session("foto_oponente");
        $nome_oponente = session("nome_oponente");
        $nivel = null;
        $pais = session("pais_oponente");
        $oponente = Personagem::find($id);
        $vez = random_int(0, 1);

        if (session()->has("nivel_oponente")) {

            $nivel = session("nivel_oponente");
            
        } else {

            $nivel = session("player.nivel");

        }
        
        if (!session()->has("dados.batalha_comecou")) {
            
            $nova_batalha = new Batalha();
            $nova_batalha->nome = session("player.usuario");
            $nova_batalha->nome_oponente = $nome_oponente;
            $nova_batalha->hp_maximo = session("player.personagem.hp") * session("player.nivel");
            $nova_batalha->hp = session("player.personagem.hp") * session("player.nivel");
            $nova_batalha->hp_maximo_oponente = $oponente->hp * $nivel;
            $nova_batalha->hp_oponente = $oponente->hp * $nivel;
            $nova_batalha->vez = $vez;
            $nova_batalha->ganhou = null;
            $nova_batalha->perdeu = null;
            $nova_batalha->created_at = date("Y-m-d H:i:s");
            $nova_batalha->updated_at = null;
            $nova_batalha->save();

            $novo_desafio = new Desafio();
            $novo_desafio->id_desafiador = session("player.id");
            $novo_desafio->id_desafiado = session("id_player");
            $novo_desafio->save();

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

            $id_batalha = session("dados.id_batalha");

            $batalha = Batalha::find($id_batalha);            
        }        

        session([
            "alerta" => [
                "titulo" => "Batalha!",
                "icone" => "bi-phone-landscape-fill",
                "texto" => "Agora é a Hora! Aqui você aplicará o que aprendeu na página de regras, e recomendo que para essa página você vire a tela do seu dispositivo. Boa sorte!",
                "pagina" => "batalha"
            ]
        ]);

        return view("batalha")
            ->with("imagem", "coliseu")
            ->with("pagina", "Batalha")
            ->with("batalha", $batalha)
            ->with("vez", $batalha->vez)
            ->with("bandeira_oponente", $pais)
            ->with("oponente", $oponente)
            ->with("foto", $foto_oponente)
            ->with("nome", $nome_oponente);
    }    
}