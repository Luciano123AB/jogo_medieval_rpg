<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desafio extends Model
{
    protected $fillable = [
        "id_desafiador",
        "id_desafiado"
    ];
}
