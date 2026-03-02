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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string("usuario", 30);
            $table->string("email", 100);
            $table->string("senha", 255);
            $table->string("genero", 9)->comment("Masculino|Feminino|Outro");
            $table->string("pais", 2);
            $table->longText("foto", 13980320)->comment("iVBORw0KGgo...");
            $table->integer("nivel")->default(1);
            $table->float("xp")->default(0)->comment("100");
            $table->integer("quantidade_vitorias")->default(0);
            $table->integer("quantidade_derrotas")->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};