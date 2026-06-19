<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personagem extends Model
{

    protected $fillable = [
        'classe',
        'imagem',
        'descricao',
        'tipo_dano',
        'alcance',
        'vida',
        'defesa',
        'hp'
    ];
    protected $casts = [
        'classe' => 'string',
        'imagem' => 'string',
        'descricao' => 'string',
        'tipo_dano' => 'string',
        'alcance' => 'string',
        'vida' => 'string',
        'defesa' => 'string',
        'hp' => 'integer'
    ];

    public function skill01() {
        return $this->belongsTo(Skill::class);
    }

    public function skill02() {
        return $this->belongsTo(Skill::class);
    }

    public function skill03() {
        return $this->belongsTo(Skill::class);
    }
}