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
        Schema::table("personagems", function (Blueprint $table) {
            $table->unsignedBigInteger("id_skill01")->nullable()->after("id");
            $table->foreign("id_skill01")->references("id")->on("skills")->nullOnDelete();
            $table->unsignedBigInteger("id_skill02")->nullable()->after("id");
            $table->foreign("id_skill02")->references("id")->on("skills")->nullOnDelete();
            $table->unsignedBigInteger("id_skill03")->nullable()->after("id");
            $table->foreign("id_skill03")->references("id")->on("skills")->nullOnDelete();
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
