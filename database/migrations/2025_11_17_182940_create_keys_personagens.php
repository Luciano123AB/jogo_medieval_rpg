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
            $table->unsignedBigInteger("skill01_id")->nullable()->after("id");
            $table->foreign("skill01_id")->references("id")->on("skills")->nullOnDelete();
            $table->unsignedBigInteger("skill02_id")->nullable()->after("id");
            $table->foreign("skill02_id")->references("id")->on("skills")->nullOnDelete();
            $table->unsignedBigInteger("skill03_id")->nullable()->after("id");
            $table->foreign("skill03_id")->references("id")->on("skills")->nullOnDelete();
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
