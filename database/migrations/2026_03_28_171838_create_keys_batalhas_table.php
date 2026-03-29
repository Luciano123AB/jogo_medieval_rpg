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
            $table->foreignId("oponente_id")->nullable()->after("player_id")->constrained("personagems")->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("batalhas", function (Blueprint $table) {
            $table->dropForeign(["player_id"]);
            $table->dropForeign(["oponente_id"]);
            $table->dropColumn([
                "player_id",
                "oponente_id"
            ]);
        });
    }
};
