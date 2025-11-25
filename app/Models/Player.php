<?php

namespace App\Models;

use App\Models\Personagem;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        "usuario",
        "email",
        "senha",
        "genero",
        "foto",
        "nivel",
        "subir_nivel",
        "quantidade_vitorias",
        "quantidade_derrotas"
    ];
    
    public function personagens() {
        return $this->hasMany(Personagem::class);
    }

    public function personagem() {
        return $this->belongsTo(Personagem::class, "id_personagem");
    }
}