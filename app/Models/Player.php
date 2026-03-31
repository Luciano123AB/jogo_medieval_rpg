<?php

namespace App\Models;

use App\Models\Personagem;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Player extends Authenticatable
{

    const UPDATED_AT = null;
    protected $fillable = [
        "user",
        "email",
        "password",
        "genero",
        "pais",
        "foto",
        "nivel",
        "subir_nivel",
        "quantidade_vitorias",
        "quantidade_derrotas",
        "online"
    ];
    protected $casts = [
        "user" => "string",
        "email" => "string",
        "password" => "string",
        "genero" => "string",
        "pais" => "string",
        "foto" => "string",
        "nivel" => "integer",
        "subir_nivel" => "float",
        "quantidade_vitorias" => "integer",
        "quantidade_derrotas" => "integer",
        "online" => "boolean"
    ];

    public function personagem() {
        return $this->belongsTo(Personagem::class);
    }
}