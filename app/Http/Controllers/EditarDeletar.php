<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Services\GenerosClasses;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EditarDeletar extends Controller
{
    public function confirmarDeletar(): RedirectResponse {
        session([
            "alerta_confirmar" => [
                "titulo" => "Confirmar Deleção!",
                "texto" => "Tem certeza que deseja deletar sua conta? Esse operação é irreversível.",
                "cancelar" => "cancelarDeletar",
                "sim" => "deletar"
            ]
        ]);

        return redirect()->back();
    }

    public function cancelarDeletar(): RedirectResponse {
        session()->forget(["alerta_confirmar"]);

        return redirect()->back();
    }

    public function deletar(): RedirectResponse {

        $id = session("player.id");
        
        $player_deletar = Player::findOrFail($id);
        $player_deletar->delete();

        if (!$player_deletar) {
            session()->forget(["alerta_confirmar"]);

            session([
                "alerta_resultado" => [
                    "titulo" => "Erro ao Deletar!",
                    "texto" => "Ocorreu um erro ao tentar excluir a conta! Tente novamente.",
                    "icone" => "bi-hand-thumbs-down-fill"
                ]
            ]);

            return redirect()->back();
        } else {
            session()->forget(["alerta_confirmar"]);
            session()->forget(["player"]);

            session([
                "alerta_resultado" => [
                    "titulo" => "Player Deletado com Sucesso!",
                    "texto" => "Caso queira começar novamente do zero, sinta-se à vontade para criar uma nova conta.",
                    "icone" => "bi-hand-thumbs-up-fill"
                ]
            ]);

            return redirect()->route("home");
        }
    }

    public function confirmarAtualizar(Request $request): RedirectResponse {
        
        $classe_escolhida = $request->input("classe");
        $foto_escolhida = $request->file("foto");
        
        $request->validate(
            [
                "novo_usuario" => "required|max:30",
                "novo_email" => "required|max:100",
                "nova_senha" => "required|max:60",
                "confirmar_nova_senha" => "required"
            ],

            [
                "novo_usuario.required" => "O campo usuário é obrigatório.",
                "novo_usuario.max" => "O nome de usuário deve ter no máximo 30 caracteres.",
                "novo_email.required" => "O campo email é obrigatório.",
                "novo_email.max" => "O email deve ter no máximo 100 caracteres.",
                "nova_senha.required" => "O campo senha é obrigatório.",
                "nova_senha.max" => "O nome de usuário deve ter no máximo 60 caracteres.",
                "confirmar_nova_senha.required" => "Confirme sua senha."
            ]
        );

        $usuario = $request->input("novo_usuario");
        $email = $request->input("novo_email");
        $senha = $request->input("nova_senha");
        $confirmar_senha = $request->input("confirmar_nova_senha");        

        if ($senha != $confirmar_senha) {
            return redirect()->back()->withInput()->withErrors(["senhas" => "As senhas estão diferentes! Tente novamente."]);
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

            $foto = session("player.foto");

        }

        $player_existente = Player::where("usuario", $usuario)
                                  ->first();
        $email_existente = Player::where("email", $email)
                                 ->first();

        if ($player_existente && $player_existente->usuario !== session("player.usuario")) {
            return redirect()->back()->withInput()->withErrors(["playerExiste" => "Esse player já está cadastrado! Tente novamente."]);
        }

        if ($email_existente && $email_existente->email !== session("player.email")) {
            return redirect()->back()->withInput()->withErrors(["playerExiste" => "Esse player já está cadastrado! Tente novamente."]);
        }

        session([
            "alerta_confirmar" => [
                "titulo" => "Confirmar Atualização!",
                "texto" => "Tem certeza que deseja salvar esses novos dados?",
                "cancelar" => "cancelarAtualizar",
                "sim" => "atualizar",
                "dados" => [
                    "usuario" => $usuario,
                    "email" => $email,
                    "senha" => $senha,
                    "classe" => $classe,
                    "foto" => $foto
                ]
            ]
        ]);

        return redirect()->back();
    }

    public function cancelarAtualizar(): RedirectResponse {
        session()->forget(["alerta_confirmar"]);

        return redirect()->back();
    }

    public function atualizar(): RedirectResponse {

        $id = session("player.id");
        $senha = session("alerta_confirmar.dados.senha");
        
        $novo_player = Player::find($id);
        $novo_player->usuario = session("alerta_confirmar.dados.usuario");
        $novo_player->email = session("alerta_confirmar.dados.email");
        $novo_player->senha = encrypt($senha);
        $novo_player->id_personagem = session("alerta_confirmar.dados.classe");
        $novo_player->foto = session("alerta_confirmar.dados.foto");
        $novo_player->updated_at = date("Y-m-d H:i:s");
        $novo_player->save();

        if (!$novo_player) {
            session()->forget(["alerta_confirmar"]);

            session([
                "alerta_resultado" => [
                    "titulo" => "Erro ao Atualizar!",
                    "texto" => "Ocorreu um erro ao tentar atualizar o player! Tente novamente.",
                    "icone" => "bi-hand-thumbs-down-fill"
                ]
            ]);

            return redirect()->back();
        } else {
            session()->forget(["alerta_confirmar"]);

            session(["player" => $novo_player]);

            session([
                "alerta_resultado" => [
                    "titulo" => "Player Atualizado com Sucesso!",
                    "texto" => "Para ver seu novo nome de usuário e(ou) classe nova, deslogue e faça o login novamente.",
                    "icone" => "bi-hand-thumbs-up-fill"
                ]
            ]);

            return redirect()->route("home");
        }
    }
}
