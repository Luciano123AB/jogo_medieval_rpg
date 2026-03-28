<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Services\GenerosClasses;
use App\Services\Salvar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditarDeletar extends Controller
{
    public function confirmarDeletar(): RedirectResponse {
        $this->alertaConfirmar("Confirmar Deleção!", "Tem certeza que deseja deletar sua conta? Esse operação é irreversível.", "deletar");

        return redirect()->back();
    }

    public function deletar(): RedirectResponse {

        $player_deletar = Player::findOrFail(Auth::user()->id);

        if (!$player_deletar->delete()) {
            $this->alertaResultado("Erro ao Deletar!", "Ocorreu um erro ao tentar excluir a conta! Tente novamente.", "bi-hand-thumbs-down-fill");

            return redirect()->back();
        }

        session()->forget("player");
        $this->alertaResultado("Player Deletado com Sucesso!", "Caso queira começar novamente do zero, sinta-se à vontade para criar uma nova conta.", "bi-hand-thumbs-up-fill");

        return redirect()->route("home");
    }

    public function confirmarAtualizar(Request $request): RedirectResponse {
        
        $foto_escolhida = $request->file("foto");
        
        $request->validate(
            [
                "novo_usuario" => "required|max:30",
                "novo_email" => "required|min:11|max:100|email",
                "nova_senha" => "required|min:3|max:60|regex:/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/",
                "confirmar_nova_senha" => "required|same:nova_senha"
            ],

            [
                "novo_usuario.required" => "O campo usuário é obrigatório.",
                "novo_usuario.max" => "O nome de usuário deve ter no máximo :max caracteres.",
                "novo_email.required" => "O campo email é obrigatório.",
                "novo_email.min" => "O email deve ter no mínimo :min caracteres.",
                "novo_email.max" => "O email deve ter no máximo :max caracteres.",
                "novo_email.email" => "O email deve ser um email válido.",
                "nova_senha.required" => "O campo senha é obrigatório.",
                "nova_senha.min" => "A senha deve ter no mínimo :min caracteres.",
                "nova_senha.max" => "A senha deve ter no máximo :max caracteres.",
                "nova_senha.regex" => "A senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número.",
                "confirmar_nova_senha.required" => "O campo confirmar senha é obrigatório.",
                "confirmar_nova_senha.same" => "As senhas não coincidem."
            ]
        );

        $usuario = $request->input("novo_usuario");
        $email = $request->input("novo_email");
        $classe = GenerosClasses::escolhaClasse($request->input("classe"));

        if ($classe == "Selecione sua classe...") {
            return redirect()->back()->withInput()->withErrors(["classe" => "Você deve escolher uma classe primeiro."]);
        }

        if (!$request->input("sem_foto")) {
            if ($foto_escolhida && $foto_escolhida->isValid()) {
                if ($foto_escolhida->getSize() > 10485760) {
                    return redirect()->back()->withInput()->with("fotoTamanho", "Essa foto é muito grande! O arquivo deve ter no máximo 10MB.");
                }

                $nome_arquivo = time() . "_" . uniqid() . "." . $foto_escolhida->getClientOriginalExtension();

                $foto_escolhida->move(public_path("fotos"), $nome_arquivo);

                $foto = "fotos/" . $nome_arquivo;
                
            } else {

                $foto = Auth::user()->foto;

            }
        } else {

            $foto = "fotos/vazio.png";

        }

        $player_existente = Player::where("usuario", $usuario)
                                  ->first();
        $email_existente = Player::where("email", $email)
                                 ->first();

        if ($player_existente && $player_existente->usuario !== Auth::user()->usuario) {
            return redirect()->back()->withInput()->withErrors(["playerExiste" => "Esse player já está cadastrado! Tente novamente."]);
        }

        if ($email_existente && $email_existente->email !== Auth::user()->email) {
            return redirect()->back()->withInput()->withErrors(["playerExiste" => "Esse player já está cadastrado! Tente novamente."]);
        }

        $this->alertaConfirmar("Confirmar Atualização!", "Tem certeza que deseja salvar esses novos dados?", "atualizar");
        session([
            "dados" => [
                "usuario" => $usuario,
                "email" => $email,
                "senha" => $request->input("nova_senha"),
                "classe" => $classe,
                "foto" => $foto
            ]
        ]);

        return redirect()->back();
    }

    public function atualizar(): RedirectResponse {

        $player = Player::findOrFail(Auth::user()->id);

        if (!Salvar::atualizar($player)) {
            $this->alertaResultado("Erro ao Atualizar!", "Ocorreu um erro ao tentar atualizar o player! Tente novamente.", "bi-hand-thumbs-down-fill");

            return redirect()->back();
        }

        Auth::setUser($player);
        $this->alertaResultado("Player Atualizado com Sucesso!", "Para ver seu novo nome de usuário e(ou) classe nova, deslogue e faça o login novamente.", "bi-hand-thumbs-up-fill");

        return redirect()->route("home");
    }
}
