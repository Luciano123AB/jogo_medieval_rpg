<?php

namespace App\Services;

class TemaAtual
{
    public static function tema() {
        
        $tema = "escuro";

        if (session("tema") == "claro") {
            $tema = "claro";
        }

        return $tema;
    }
}
