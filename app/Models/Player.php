<?php

namespace App\Models;

use App\Models\Personagem;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{

    const UPDATED_AT = null;
    protected $fillable = [
        "usuario",
        "email",
        "senha",
        "genero",
        "pais",
        "foto",
        "nivel",
        "subir_nivel",
        "quantidade_vitorias",
        "quantidade_derrotas"
    ];
    protected $casts = [
        "usuario" => "string",
        "email" => "string",
        "senha" => "string",
        "genero" => "string",
        "pais" => "string",
        "foto" => "string",
        "nivel" => "integer",
        "subir_nivel" => "float",
        "quantidade_vitorias" => "integer",
        "quantidade_derrotas" => "integer"
    ];

    public function personagem() {
        return $this->belongsTo(Personagem::class);
    }
}