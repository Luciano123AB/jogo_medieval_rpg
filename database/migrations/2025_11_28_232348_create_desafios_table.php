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
        Schema::create("desafios", function (Blueprint $table) {
            $table->id();
            $table->foreignId("desafiador_id")->nullable()->constrained("players")->nullOnDelete();
            $table->foreignId("desafiado_id")->nullable()->constrained("players")->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("desafios");
    }
};
