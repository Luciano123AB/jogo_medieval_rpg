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

    protected function alertaConfirmar(string $titulo, string $texto, string $cancelar, string $sim) {
        $session = session([
            "alerta_confirmar" => [
                "titulo" => $titulo,
                "texto" => $texto,
                "cancelar" => $cancelar,
                "sim" => $sim
            ]
        ]);

        return $session;
    }

    protected function alertaConfirmarRender(string $titulo, string $texto, string $cancelar, string $sim) {
        $session = session([
            "alerta_confirmar_render" => [
                "titulo" => $titulo,
                "texto" => $texto,
                "cancelar" => $cancelar,
                "sim" => $sim
            ]
        ]);

        return $session;
    }

    protected function alertaResultado(string $titulo, string $texto, string $icone) {
        $session = session([
            "alerta_resultado" => [
                "titulo" => $titulo,
                "texto" => $texto,
                "icone" => $icone
            ]
        ]);

        return $session;
    }

    protected function alertaBatalha(string $titulo, string $texto, string $icone, string $rota) {
        $session = session([
            "alerta_batalha" => [
                "titulo" => $titulo,
                "texto" => $texto,
                "icone" => $icone,
                "rota" => $rota
            ]
        ]);

        return $session;
    }
}
