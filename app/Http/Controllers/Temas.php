<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class Temas extends Controller
{
    public function mudarTema(): RedirectResponse {
        if (!session()->has('tema')) {
            session(['tema' => 'escuro']);

            return redirect()->back();
        } else {
            if (session('tema') == 'claro') {
                session(['tema' => 'escuro']);

                return redirect()->back();
            }

            session(['tema' => 'claro']);

            return redirect()->back();
        }
    }
}
