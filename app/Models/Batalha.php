<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batalha extends Model
{

    const UPDATED_AT = null;
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
    protected $casts = [
        "nome" => "string",
        "nome_oponente" => "string",
        "hp_maximo" => "integer",
        "hp" => "integer",
        "hp_maximo_oponente" => "integer",
        "hp_oponente" => "integer",
        "vez" => "integer",
        "ganhou" => "string",
        "perdeu" => "string"
    ];

    use SoftDeletes;
}