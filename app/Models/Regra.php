<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regra extends Model
{
    protected $fillable = [
        "regra",
        "explicacao",
        "icone",
        "imagem",
        "animacao01",
        "animacao02"
    ];
}