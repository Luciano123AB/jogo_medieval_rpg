<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Services\GenerosClasses;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Cadastrar extends Controller
{
    public function confirmarCadastrar(Request $request): RedirectResponse {
        
        $genero_escolhida = $request->input("genero");
        $classe_escolhida = $request->input("classe");
        $foto_escolhida = $request->file("foto");
        
        $request->validate(
            [
                "novo_usuario" => "required|max:30",
                "novo_email" => "required|max:100",
                "nova_senha" => "required|max:60",
                "confirmar_nova_senha" => "required",
                "pais" => "required"
            ],

            [
                "novo_usuario.required" => "O campo usuário é obrigatório.",
                "novo_usuario.max" => "O nome de usuário deve ter no máximo 30 caracteres.",
                "novo_email.required" => "O campo email é obrigatório.",
                "novo_email.max" => "O email deve ter no máximo 100 caracteres.",
                "nova_senha.required" => "O campo senha é obrigatório.",
                "nova_senha.max" => "O nome de usuário deve ter no máximo 60 caracteres.",
                "confirmar_nova_senha.required" => "Confirme sua senha.",
                "pais.required" => "Selecione seu país."
            ]
        );

        $usuario = $request->input("novo_usuario");
        $email = $request->input("novo_email");
        $senha = $request->input("nova_senha");
        $confirmar_senha = $request->input("confirmar_nova_senha");
        $pais = $request->input("pais");
        $foto = "";

        if ($senha != $confirmar_senha) {
            return redirect()->back()->withInput()->withErrors(["senhas" => "As senhas estão diferentes! Tente novamente."]);
        }

        $genero = GenerosClasses::escolhaGenero($genero_escolhida);

        if ($genero == "Selecione seu gênero...") {
            return redirect()->back()->withInput()->withErrors(["genero" => "Selecione seu gênero também."]);
        }

        $classe = GenerosClasses::escolhaClasse($classe_escolhida);

        if ($classe == "Selecione sua classe...") {
            return redirect()->back()->withInput()->withErrors(["classe" => "Você deve escolher uma classe primeiro."]);
        }

        if ($foto_escolhida && $foto_escolhida->isValid()) {

            $foto_tamanho = $foto_escolhida->getSize();
            $tamanho_maximo = 10485760;

            if ($foto_tamanho > $tamanho_maximo) {
                return redirect()->back()->withInput()->with("fotoTamanho", "Essa foto é muito grande.");
            }

            $foto_conteudo = file_get_contents($foto_escolhida->getRealPath());

            if (!$foto_conteudo) {
                return redirect()->back()->withInput()->with("fotoErro", "Não foi possível carregar esta foto. Tente novamente.");
            }

            $foto = base64_encode($foto_conteudo);
        } else {
            $foto = "nenhuma";
        }

        $player_existente = Player::where("usuario", $usuario)
                                  ->first();
        $email_existente = Player::where("email", $email)
                                  ->first();

        if ($player_existente || $email_existente) {
            return redirect()->back()->withInput()->withErrors(["playerExiste" => "Esse player já está cadastrado! Tente novamente."]);
        }

        $this->alertaConfirmar("Confirmação Cadastro!", "Tem certeza que deseja cadastrar esse player?", "cancelar", "cadastrar");
        session([
            "dados" => [
                "usuario" => $usuario,
                "email" => $email,
                "senha" => $senha,
                "genero" => $genero,
                "pais" => $pais,
                "classe" => $classe,
                "foto" => $foto
            ]
        ]);

        return redirect()->back()->withInput();
    }

    public function cadastroSubmit(): RedirectResponse {

        $player = new Player();
        $player->usuario = session("dados.usuario");
        $player->email = session("dados.email");
        $player->senha = encrypt(session("dados.senha"));
        $player->genero = session("dados.genero");
        $player->pais = session("dados.pais");
        $player->foto = session("dados.foto");
        $player->nivel = 1;
        $player->xp = 0;
        $player->quantidade_vitorias = 0;
        $player->quantidade_derrotas = 0;
        $player->id_personagem = session("dados.classe");
        $player->created_at = date("Y-m-d H:i:s");
        $player->save();

        if (!$player) {
            session()->forget("alerta_confirmar");

            $this->alertaResultado("Erro ao Cadastrar!", "Ocorreu um erro ao tentar cadastrar esse player! Tente novamente.", "bi-hand-thumbs-down-fill");

            return redirect()->back()->withInput();
        } else {
            session()->forget("alerta_confirmar");
            
            $this->alertaResultado("Player Cadastrado com Sucesso!", "Agora você pode realizar o login e acessar a página de batalha.", "bi-hand-thumbs-up-fill");

            return redirect()->route("home");
        }
    }
}