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
        Schema::table('personagems', function (Blueprint $table) {
            $table->foreignId('skill01_id')->nullable()->after('id')->constrained('skills')->nullOnDelete();
            $table->foreignId('skill02_id')->nullable()->after('skill01_id')->constrained('skills')->nullOnDelete();
            $table->foreignId('skill03_id')->nullable()->after('skill02_id')->constrained('skills')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personagems', function (Blueprint $table) {
            $table->dropForeign(['skill01_id']);
            $table->dropForeign(['skill02_id']);
            $table->dropForeign(['skill03_id']);
            $table->dropColumn([
                'skill01_id',
                'skill02_id',
                'skill03_id'
            ]);
        });
    }
};
