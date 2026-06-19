<?php

namespace App\Services;

class GenerosClasses
{
    public static function escolhaGenero($genero_escolhida) {
        switch ($genero_escolhida) {
            case 'Masculino':
                return 'Masculino';
            break;

            case 'Feminino':
                return 'Feminino';
            break;

            case 'Outro':
                return 'Outro';
            break;
            
            default:
                return 'Selecione seu gênero...';
            break;
        }
    }

    public static function escolhaClasse($classe_escolhida) {
        switch ($classe_escolhida) {
            case 'Guerreiro':
                return 1;
            break;

            case 'Mago':
                return 2;
            break;

            case 'Assassino':
                return 3;
            break;
            
            default:
                return 'Selecione sua classe...';
            break;
        }
    }
}
