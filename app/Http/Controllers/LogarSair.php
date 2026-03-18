<?php

namespace App\Http\Controllers;

use App\Models\Batalha;
use App\Models\Player;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LogarSair extends Controller
{
    public function logar(Request $request): RedirectResponse {
        $request->validate(
            [
                "email" => "required",
                "senha" => "required"
            ],

            [
                "email.required" => "O campo email é obrigatório.",
                "senha.required" => "O campo senha é obrigatório."
            ]
        );

        $email = $request->input("email");
        $senha = $request->input("senha");

        $player = Player::where("email", $email)
                        ->first();        

        if (!$player) {
            return redirect()->back()->withInput()->withErrors(["playerNaoExiste" => "Esse player não está cadastrado! Tente outro."]);
        }

        if (Hash::check($senha, $player->senha)) {
            return redirect()->back()->withInput()->withErrors(["playerNaoExiste" => "Esse player não está cadastrado! Tente outro."]);
        }

        $batalha_inacabada = Batalha::where("nome", $player->usuario)
                                    ->whereNull("ganhou")
                                    ->first();
                                    
        $batalha_inacabada?->forceDelete();

        session([
            "xp" => $player->xp,
            "player" => $player
        ]);
        $this->alertaResultado("Login Efetuado com Sucesso!", "Agora você pode acessar a batalha e outras páginas.", "bi-hand-thumbs-up-fill");

        return redirect()->route("home");
    }

    public function confirmarSair(): RedirectResponse {
        $this->alertaConfirmar("Confirmar Saída!", "Tem certeza que deseja sair?", "sair");

        return redirect()->back();
    }

    public function sair(): RedirectResponse {
        session()->forget("player");

        return redirect()->route("home");
    }
}
