<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function alerta(string $titulo, string $icone, string $texto, string $pagina) {
        return session()->flash(
            'alerta', [
                'titulo' => $titulo,
                'icone' => $icone,
                'texto' => $texto,
                'pagina' => $pagina
            ]
        );
    }

    protected function alertaConfirmar(string $titulo, string $texto, string $sim) {
        return session()->flash(
            'alerta_confirmar', [
                'titulo' => $titulo,
                'texto' => $texto,
                'sim' => $sim
            ]
        );
    }

    protected function alertaResultado(string $titulo, string $texto, string $icone) {
        return session()->flash(
            'alerta_resultado', [
                'titulo' => $titulo,
                'texto' => $texto,
                'icone' => $icone
            ]
        );
    }

    protected function alertaBatalha(string $titulo, string $texto, string $icone, string $rota) {
        return session()->flash(
            'alerta_batalha', [
                'titulo' => $titulo,
                'texto' => $texto,
                'icone' => $icone,
                'rota' => $rota
            ]
        );
    }
}
