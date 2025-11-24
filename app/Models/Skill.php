<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        "skill",
        "dano01",
        "dano02",
        "dano03"
    ];

    public function personagem() {
        return $this->belongsTo(Personagem::class);
    }
}