<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function alerta(string $titulo, string $icone, string $texto, string $pagina) {
        $session = session([
            "alerta" => [
                "titulo" => $titulo,
                "icone" => $icone,
                "texto" => $texto,
                "pagina" => $pagina
            ]
        ]);

        return $session;
    }
}
