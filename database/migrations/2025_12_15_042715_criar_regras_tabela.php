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
            $table->id()->autoIncrement()->comment("1");
            $table->string("regra", 20)->nullable()->comment("...");
            $table->string("explicacao", 300)->nullable()->comment("...");
            $table->string("icone", 15)->nullable()->comment("bi-...");
            $table->string("imagem", 20)->nullable()->comment("nome_imagem");
            $table->string("animacao", 30)->nullable()->comment("animate__...");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
