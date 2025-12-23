<?php

namespace App\Http\Controllers;

use App\Models\Batalha;
use App\Models\Desafio;
use App\Models\Personagem;
use App\Models\Player;
use App\Models\Regra;
use App\Services\Paises;
use App\Services\PlayersPais;
use Illuminate\Contracts\View\View;

class MainController extends Controller
{
    public function regras(): View {
        $this->alerta("Regras do Jogo!", "bi-question-circle-fill", "Aqui você entenderá como o jogo funciona.", "regras");

        $regras = Regra::all();
        $temas = ["secondary", "primary", "escuro"];
        
        if (session("tema") == "claro" || !session()->has("tema")) {
            $temas = ["dark", "danger", "claro"];
        }

        return view("regras")
            ->with("imagem", "campo_treinamento")
            ->with("pagina", "Regras")
            ->with("regras", $regras)
            ->with("temas", $temas);
    }

    public function sobreClasses(): View {
        $this->alerta("Descrição das Classes!", "bi-person-lines-fill", "Aqui você vai entender como cada classe funciona.", "sobre");

        $personagens = Personagem::all();
        $temas = ["secondary", "primary", "escuro"];
        
        if (session("tema") == "claro" || !session()->has("tema")) {
            $temas = ["dark", "danger", "claro"];
        }

        return view("sobre_classes")
            ->with("imagem", "estatuas_classes")
            ->with("pagina", "Descrições")
            ->with("personagens", $personagens)
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

        $personagens = Personagem::all();
        $paises = Paises::paises();
        $temas = ["secondary", "primary", "light", "black", "escuro"];
        
        if (session("tema") == "claro" || !session()->has("tema")) {
            $temas = ["dark", "danger", "dark", "white", "claro"];
        }

        return view("cadastro_atualizacao", compact("paises"))
            ->with("imagem", "recrutamento")
            ->with("pagina", "Cadastro")
            ->with("personagens", $personagens)
            ->with("temas", $temas);
    }

    public function atualizacao(): View {
        $this->alerta("Atualização de Player!", "bi-person-fill-down", "Aqui você editará os dados da sua conta e escolherá sua nova classe preferencial.", "atualizacao");

        $personagens = Personagem::all();
        $id = session("player.id");
        $usuario = session("player.usuario");
        $email = session("player.email");
        $senha = decrypt(session("player.senha"));
        $classe = session("player.personagem.classe");
        $foto = session("player.foto");
        $paises = Paises::paises();
        $temas = ["secondary", "primary", "light", "black", "escuro"];
        
        if (session("tema") == "claro" || !session()->has("tema")) {
            $temas = ["dark", "danger", "dark", "white", "claro"];
        }

        return view("cadastro_atualizacao", compact("paises"))
            ->with("imagem", "recrutamento")
            ->with("pagina", "Atualização")
            ->with("personagens", $personagens)
            ->with("temas", $temas)
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
        $this->alerta("Lista de Players!", "bi-list-stars", "Aqui você vizualizará todos os players existentes e quem está na liderança, e caso queira, poderá desafiá-los para uma batalha, mas só poderá fazer isso 1 vez por dia.", "listagem");

        $players = Player::orderBy("usuario", "asc")->get();
        $player_lider_vitorias = Player::orderBy("quantidade_vitorias", "desc")->first();
        $player_lider_nivel = Player::orderBy("nivel", "desc")->first();
        $desafiou = Desafio::where("id_desafiador", session("player.id"))
                           ->pluck("id_desafiado")
                           ->toArray();
        $temas = ["secondary", "primary", "light", "escuro"];
        
        if (session("tema") == "claro" || !session()->has("tema")) {
            $temas = ["dark", "danger", "dark", "claro"];
        }

        return view("listagens/players")
            ->with("imagem", "recrutamento")
            ->with("pagina", "Listagem")
            ->with("players", $players)
            ->with("player_lider_vitorias", $player_lider_vitorias)
            ->with("player_lider_nivel", $player_lider_nivel)
            ->with("desafiou", $desafiou)
            ->with("temas", $temas);
    }

    public function totaisPlayers() {
        $this->alerta("Totais de Players!", "bi-flag-list", "Aqui você descobrirá quantos players de cada país estão presentes no jogo.", "totais");

        $paises = Paises::paises();
        $totaisBanco = PlayersPais::playersPais();
        $totais = [];

        foreach ($paises as $codigo => $nome) {
            $totais[$codigo] = [
                "nome"  => $nome,
                "total" => $totaisBanco[$codigo] ?? 0
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
        $this->alerta("Registro de Batalhas!", "bi-file-earmark-medical-fill", "Aqui você irá relembrar todas as suas vitórias e derrotas, e caso queira, poderá apagar esses registros.", "registro");

        $batalhas_vitorias = Batalha::onlyTrashed()
                                    ->where("ganhou", session("player.usuario"))
                                    ->get();
        $batalhas_derrotas = Batalha::onlyTrashed()
                                    ->where("perdeu", session("player.usuario"))
                                    ->get();
        $temas = ["secondary", "primary", "light", "escuro"];
        
        if (session("tema") == "claro" || !session()->has("tema")) {
            $temas = ["dark", "danger", "dark", "claro"];
        }

        return view("listagens/registro_batalhas")
            ->with("imagem", "registros")
            ->with("pagina", "Registro")
            ->with("batalhas_vitorias", $batalhas_vitorias)
            ->with("batalhas_derrotas", $batalhas_derrotas)
            ->with("temas", $temas);
    }

    public function batalhasAndamento(): View {
        $this->alerta("Batalhas em Andamento!", "bi-card-list", "Aqui você irá vizualizar todas as batalhas que estão acontecendo agora.", "batalhas");

        $batalhas = Batalha::where("deleted_at", null)->get();
        $temas = ["secondary", "primary", "escuro"];
        
        if (session("tema") == "claro" || !session()->has("tema")) {
            $temas = ["dark", "danger", "claro"];
        }

        return view("listagens/batalhas")
            ->with("imagem", "registros")
            ->with("pagina", "Batalhas")
            ->with("batalhas", $batalhas)
            ->with("temas", $temas);
    }

    public function preparacao(): View {
        $this->alerta("Preparação Antes da Batalha!", "⚔️", "Aqui você escolherá quem irá enfrentar usando sua classe.", "preparacao");

        $personagens = Personagem::all();
        $classe_player = session("player.personagem.classe");
        $id = session("player.id");
        $nivel = Player::find($id);
        $temas = ["secondary", "primary", "cor_niveis", "light", "escuro"];
        
        if (session("tema") == "claro" || !session()->has("tema")) {
            $temas = ["dark", "danger", "text-danger", "dark", "claro"];
        }

        return view("preparacao")
            ->with("imagem", "coliseu")
            ->with("pagina", "Preparação")
            ->with("personagens", $personagens)
            ->with("classe", $classe_player)
            ->with("nivel", $nivel->nivel)
            ->with("temas", $temas);
    }

    public function batalhar(): View {
        $this->alerta("Batalha!", "bi-phone-landscape-fill", "Agora é a Hora! Aqui você aplicará o que aprendeu na página de regras, e recomendo que para essa página você vire a tela do seu dispositivo. Boa sorte!", "batalha");
        
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

        $temas = ["secondary", "primary", "escuro"];
        
        if (session("tema") == "claro" || !session()->has("tema")) {
            $temas = ["dark", "danger", "claro"];
        }

        return view("batalha")
            ->with("imagem", "coliseu")
            ->with("pagina", "Batalha")
            ->with("batalha", $batalha)
            ->with("vez", $batalha->vez)
            ->with("bandeira_oponente", $pais)
            ->with("oponente", $oponente)
            ->with("foto", $foto_oponente)
            ->with("nome", $nome_oponente)
            ->with("temas", $temas);
    }    
}