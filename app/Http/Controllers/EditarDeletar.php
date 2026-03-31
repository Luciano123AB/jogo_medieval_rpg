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

        if (file_exists(public_path(Auth::user()->foto))) {
            unlink(public_path(Auth::user()->foto));
        }

        $this->alertaResultado("Player Deletado com Sucesso!", "Caso queira começar novamente do zero, sinta-se à vontade para criar uma nova conta.", "bi-hand-thumbs-up-fill");

        return redirect()->route("sair");
    }

    public function confirmarAtualizar(Request $request): RedirectResponse {
        
        $foto_escolhida = $request->file("foto");
        
        $request->validate(
            [
                "novo_usuario" => "required|max:30",
                "novo_email" => "required|min:11|max:100|email",
                "foto" => "nullable|image|mimes:png,jpeg,jpg,gif|max:10240"
            ],

            [
                "novo_usuario.required" => "O campo usuário é obrigatório.",
                "novo_usuario.max" => "O nome de usuário deve ter no máximo :max caracteres.",
                "novo_email.required" => "O campo email é obrigatório.",
                "novo_email.min" => "O email deve ter no mínimo :min caracteres.",
                "novo_email.max" => "O email deve ter no máximo :max caracteres.",
                "novo_email.email" => "O email deve ser um email válido.",
                "foto.image" => "O campo foto deve ser uma imagem válida.",
                "foto.mimes" => "A foto deve ser do tipo: png, jpeg, jpg ou gif.",
                "foto.max" => "A imagem deve ter no máximo 10MB."
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

                $nome_arquivo = time() . "_" . uniqid() . "." . $foto_escolhida->extension();

                $foto_escolhida->move(public_path("temp_photos"), $nome_arquivo);

                $foto = $nome_arquivo;
                
            } else {

                $foto = Auth::user()->foto;

            }
        } else {

            $foto = "photos/vazio.png";

        }

        $player_existente = Player::where("user", $usuario)
                                  ->first();
        $email_existente = Player::where("email", $email)
                                 ->first();

        if ($player_existente && $player_existente->user !== Auth::user()->user) {
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

        if ($player->foto != Auth::user()->foto) {

            $caminho_foto = public_path("temp_photos/" . $player->foto);
            $novo_caminho = public_path("photos/" . $player->foto);

            if (file_exists($caminho_foto)) {
                rename($caminho_foto, $novo_caminho);
                unlink(public_path("photos/" . session("foto_antiga")));

                $player->foto = "photos/" . $player->foto;
                $player->save();
            }
        }

        Auth::setUser($player);

        $this->alertaResultado("Player Atualizado com Sucesso!", "Suas novas informações já estão em vigor.", "bi-hand-thumbs-up-fill");

        return redirect()->route("home");
    }

    public function confirmarSenha(Request $request): RedirectResponse {
        $request->validate(
            [
                "senha_atual" => "required",
                "nova_senha" => "required|min:3|max:60|regex:/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/",
                "confirmar_nova_senha" => "required|same:nova_senha"
            ],

            [
                "senha_atual.required" => "O campo senha atual é obrigatório.",
                "nova_senha.required" => "O campo nova senha é obrigatório.",
                "nova_senha.min" => "A nova senha deve ter no mínimo :min caracteres.",
                "nova_senha.max" => "A nova senha deve ter no máximo :max caracteres.",
                "nova_senha.regex" => "A nova senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número.",
                "confirmar_nova_senha.required" => "O campo confirmar nova senha é obrigatório.",
                "confirmar_nova_senha.same" => "As novas senhas não coincidem."
            ]
        );

        if (!password_verify($request->input("senha_atual"), Auth::user()->password)) {
            return redirect()->back()->withInput()->withErrors(["senha_invalida" => "A senha atual está incorreta."]);
        }

        $this->alertaConfirmar("Confirmar Atualização de Senha!", "Tem certeza que deseja salvar essa nova senha?", "atualizarSenha");
        session([
            "nova_senha" => $request->input("nova_senha")
        ]);

        return redirect()->back();
    }

    public function atualizarSenha(): RedirectResponse {

        $player = Player::findOrFail(Auth::user()->id);

        if (!Salvar::atualizarSenha($player)) {
            $this->alertaResultado("Erro ao Atualizar Senha!", "Ocorreu um erro ao tentar atualizar a senha! Tente novamente.", "bi-hand-thumbs-down-fill");

            return redirect()->back();
        }

        Auth::setUser($player);

        $this->alertaResultado("Senha Atualizada com Sucesso!", "Sua nova senha já está em vigor.", "bi-hand-thumbs-up-fill");

        return redirect()->route("home");
    }
}
