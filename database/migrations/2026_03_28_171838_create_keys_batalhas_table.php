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
        Schema::table("batalhas", function (Blueprint $table) {
            $table->foreignId("player_id")->nullable()->after("id")->constrained("players")->nullOnDelete();
            $table->foreignId("oponente_id")->nullable()->after("player_id")->constrained("players")->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropForeign(["player_id"]);
        Schema::dropForeign(["oponente_id"]);
        Schema::dropColumn([
            "player_id",
            "oponente_id"
        ]);
    }
};
