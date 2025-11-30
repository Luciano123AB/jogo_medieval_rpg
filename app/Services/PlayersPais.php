<?php

namespace App\Services;

use App\Models\Player;

class PlayersPais
{
    public static function playersPais($pais) {
        
        $quantidade = Player::where("pais", $pais)
                            ->count();
                                
        return $quantidade;
    }
}
