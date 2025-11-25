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
            $table->id()->autoIncrement()->comment("1");
            $table->string("usuario", 30)->nullable()->comment("Usuario123AB");
            $table->string("email", 100)->nullable()->comment("usuario@gmail.com");
            $table->string("senha", 255)->nullable()->comment("***");
            $table->string("genero", 9)->nullable()->comment("Masculino|Feminino|Outro");
            $table->longText("foto", 13980320)->comment("iVBORw0KGgo...");
            $table->integer("nivel")->nullable()->default(1)->comment("1");
            $table->float("xp")->nullable()->default(0)->comment("99");
            $table->integer("quantidade_vitorias")->default(0)->comment("10");
            $table->integer("quantidade_derrotas")->default(0)->comment("10");
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