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
            $table->id()->autoIncrement()->comment("1");
            $table->string("nome")->nullable()->comment("Player");
            $table->string("nome_oponente")->nullable()->comment("Oponente");
            $table->integer("hp")->nullable()->comment("2200");
            $table->integer("hp_oponente")->nullable()->comment("3200");
            $table->integer("vez")->nullable()->comment("0|1");
            $table->string("ganhou", 30)->nullable()->comment("Player|Oponente");
            $table->string("perdeu", 30)->nullable()->comment("Player|Oponente");
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
