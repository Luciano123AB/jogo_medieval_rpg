<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desafio extends Model
{
    const UPDATED_AT = null;
    
    protected $fillable = [
        "id_desafiador",
        "id_desafiado"
    ];

    protected $casts = [
        "id_desafiador" => "integer",
        "id_desafiado" => "integer"
    ];
}
