<?php

namespace App\Http\Controllers;

use App\Models\Batalha;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Resetar extends Controller
{
    public function resetarVitorias(): RedirectResponse {

        $vitorias = Batalha::where("ganhou", Auth::user()->usuario);

        if (!$vitorias->forceDelete()) {
            $this->alertaResultado("Erro ao Resetar!", "Ocorreu um erro ao tentar resetar as vitórias! Tente novamente.", "bi-hand-thumbs-down-fill");

            return redirect()->back();
        }

        $this->alertaResultado("Vitórias Resetadas com Sucesso!", "Histórico de vitórias limpado com êxito.", "bi-hand-thumbs-up-fill");

        return redirect()->back();
    }

    public function resetarDerrotas(): RedirectResponse {
        
        $derrotas = Batalha::where("perdeu", Auth::user()->usuario);

        if (!$derrotas->forceDelete()) {
            $this->alertaResultado("Erro ao Resetar!", "Ocorreu um erro ao tentar resetar as derrotas! Tente novamente.", "bi-hand-thumbs-down-fill");

            return redirect()->back();
        }

        $this->alertaResultado("Derrotas Resetadas com Sucesso!", "Histórico de derrotas limpado com êxito.", "bi-hand-thumbs-up-fill");

        return redirect()->back();
    }

    public function excluir($id) {

        $batalha = Batalha::where("id", Crypt::decrypt($id))
                        ->whereNotNull("deleted_at")
                        ->where(function ($query) {
                            $query->where("ganhou", Auth::user()->usuario)
                                  ->orWhere("perdeu", Auth::user()->usuario);
                        });

        if (!$batalha->forceDelete()) {
            $this->alertaResultado("Erro ao Excluir!", "Ocorreu um erro ao tentar excluir a batalha! Tente novamente.", "bi-hand-thumbs-down-fill");

            return redirect()->back();
        }

        return redirect()->back();
    }
}
