<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LogarSair extends Controller
{
    public function logar(Request $request): RedirectResponse {
        $request->validate(
            [
                "usuario" => "required",
                "senha" => "required"
            ],

            [
                "usuario.required" => "O campo usuário é obrigatório.",
                "senha.required" => "O campo senha é obrigatório."
            ]
        );

        $usuario = $request->input("usuario");
        $senha = $request->input("senha");

        $player = Player::where("usuario", $usuario)
                        ->first();        

        if (!$player) {
            return redirect()->back()->withInput()->withErrors(["playerNaoExiste" => "Esse player não está cadastrado! Tente novamente."]);
        }

        $player_senha = decrypt($player->senha);

        if ($player_senha != $senha) {
            return redirect()->back()->withInput()->withErrors(["playerNaoExiste" => "Esse player não está cadastrado! Tente novamente."]);
        }

        session([
            "xp" => $player->xp,
            "player" => $player,

            "alerta_resultado" => [
                "titulo" => "Login Efetuado com Sucesso!",
                "texto" => "Agora você pode acessar a página de batalha.",
                    "icone" => "bi-hand-thumbs-up-fill"
            ]
        ]);

        return redirect()->route("home");
    }

    public function confirmarSair(): RedirectResponse {
        session([
            "alerta_confirmar" => [
                "titulo" => "Confirmar Saída!",
                "texto" => "Tem certeza que deseja sair?",
                "cancelar" => "cancelarSair",
                "sim" => "sair"
            ]
        ]);

        return redirect()->back();
    }

    public function cancelar(): RedirectResponse {
        session()->forget("alerta_confirmar");

        return redirect()->back();
    }

    public function sair(): RedirectResponse {
        session()->forget("alerta_confirmar");        
        session()->forget(["player"]);

        return redirect()->route("home");
    }
}
