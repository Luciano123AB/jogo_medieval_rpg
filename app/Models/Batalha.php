<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batalha extends Model
{
    protected $fillable = [
        "nome",
        "nome_oponente",
        "hp_maximo",
        "hp",
        "hp_maximo_oponente",
        "hp_oponente",
        "vez",
        "ganhou",
        "perdeu"
    ];

    use SoftDeletes;
}