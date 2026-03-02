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
        Schema::create('batalhas', function (Blueprint $table) {
            $table->id();
            $table->string("nome");
            $table->string("nome_oponente");
            $table->integer("hp_maximo")->comment("2200");
            $table->integer("hp")->comment("2200");
            $table->integer("hp_maximo_oponente")->comment("3200");
            $table->integer("hp_oponente")->comment("3200");
            $table->integer("vez")->comment("0|1");
            $table->string("ganhou", 30)->comment("Player|Oponente");
            $table->string("perdeu", 30)->comment("Player|Oponente");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batalhas');
    }
};
