<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personagems', function (Blueprint $table) {
            $table->id();
            $table->string('classe', 9)->unique()->comment('Guerreiro | Mago | Assassino');
            $table->string('imagem', 13)->unique()->comment('guerreiro.png | mago.png | assassino.png');
            $table->string('descricao', 366)->unique();
            $table->string('tipo_dano', 6)->comment('Físico | Mágico');
            $table->string('alcance', 5)->comment('Curto | Longo');
            $table->string('vida')->comment('Baixa | Alta');
            $table->string('defesa', 5)->comment('Baixa | Alta');
            $table->integer('hp')->comment('1100 | 1300 | 1600');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personagems');
    }
};