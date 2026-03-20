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
        Schema::create("regras", function(Blueprint $table) {
            $table->id();
            $table->string("regra", 20)->unique();
            $table->string("explicacao", 300)->unique();
            $table->string("icone", 15)->comment("bi-...");
            $table->string("imagem", 20)->unique()->comment("nome_imagem");
            $table->string("animacao01", 30)->comment("animate__...");
            $table->string("animacao02", 30)->comment("animate__...");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("regras");
    }
};
