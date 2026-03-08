<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Services\GenerosClasses;
use App\Services\Salvar;
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
                "novo_email" => "required|min:11|max:100|email",
                "nova_senha" => "required|min:3|max:60|regex:/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/",
                "confirmar_nova_senha" => "required|same:nova_senha",
                "pais" => "required"
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
                "confirmar_nova_senha.same" => "As senhas não coincidem.",
                "pais.required" => "A seleção do país é obrigatória."
            ]
        );

        $usuario = $request->input("novo_usuario");
        $email = $request->input("novo_email");
        $senha = $request->input("nova_senha");
        $pais = $request->input("pais");
        $foto = "";

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

        $this->alertaConfirmar("Confirmação Cadastro!", "Tem certeza que deseja cadastrar esse player?", "cadastrar");
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

        $novo_player = new Player();
        $cadastrar_novo_player = Salvar::cadastrar($novo_player);

        if (!$cadastrar_novo_player) {
            $this->alertaResultado("Erro ao Cadastrar!", "Ocorreu um erro ao tentar cadastrar esse player! Tente novamente.", "bi-hand-thumbs-down-fill");

            return redirect()->back()->withInput();
        }
        
        session([
            "xp" => $novo_player->xp,
            "player" => $novo_player
        ]);
        $this->alertaResultado("Player Cadastrado com Sucesso!", "Agora você pode acessar a batalha e outras páginas.", "bi-hand-thumbs-up-fill");

        return redirect()->route("home");
    }
}