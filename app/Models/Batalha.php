<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batalha extends Model
{
    use SoftDeletes;

    const UPDATED_AT = null;
    protected $fillable = [
        'inicio',
        'nome',
        'skill01',
        'skill02',
        'skill03',
        'nome_oponente',
        'skill01_oponente',
        'skill02_oponente',
        'skill03_oponente',
        'hp_maximo',
        'hp',
        'hp_maximo_oponente',
        'hp_oponente',
        'vez',
        'ganhou',
        'perdeu'
    ];
    protected $casts = [
        'inicio' => 'boolean',
        'nome' => 'string',
        'skill01' => 'boolean',
        'skill02' => 'boolean',
        'skill03' => 'boolean',
        'nome_oponente' => 'string',
        'skill01_oponente' => 'boolean',
        'skill02_oponente' => 'boolean',
        'skill03_oponente' => 'boolean',
        'hp_maximo' => 'integer',
        'hp' => 'integer',
        'hp_maximo_oponente' => 'integer',
        'hp_oponente' => 'integer',
        'vez' => 'integer',
        'ganhou' => 'string',
        'perdeu' => 'string'
    ];

}