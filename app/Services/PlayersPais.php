<?php

namespace App\Services;

use App\Models\Player;
use Illuminate\Support\Facades\DB;

class PlayersPais
{
    public static function playersPais() {
        return Player::select("pais", DB::raw('COUNT(*) as total'))
                     ->whereNotNull("pais")
                     ->groupBy("pais")
                     ->pluck("total", "pais");
    }
}
