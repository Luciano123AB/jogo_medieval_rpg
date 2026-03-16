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
        Schema::table("players", function (Blueprint $table) {
            $table->unsignedBigInteger("personagem_id")->after("id");
            $table->foreign("personagem_id")->references("id")->on("personagems")->comment("1|2|3");
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
