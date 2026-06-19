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
            $table->string('user', 30)->unique();
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->string('genero', 9)->comment('Masculino | Feminino | Outro');
            $table->string('pais', 2);
            $table->text('foto')->comment('photos/***.png');
            $table->integer('nivel')->default(1);
            $table->integer('xp')->default(0)->comment('1000');
            $table->integer('quantidade_vitorias')->default(0);
            $table->integer('quantidade_derrotas')->default(0);
            $table->boolean('online')->default(false);
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