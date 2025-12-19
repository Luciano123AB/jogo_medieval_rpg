<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class Temas extends Controller
{
    public function mudarTema(): RedirectResponse {
        if (!session()->has("tema")) {
            session(["tema" => "escuro"]);            
        } else {
            if (session("tema") == "claro") {
                session(["tema" => "escuro"]);

                return redirect()->back();
            }

            if (session("tema") == "escuro") {
                session(["tema" => "claro"]);

                return redirect()->back();
            }
        }

        return redirect()->back();
    }
}
