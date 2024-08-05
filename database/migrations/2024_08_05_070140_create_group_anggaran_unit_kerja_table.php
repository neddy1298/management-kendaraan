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
        Schema::create('group_anggaran_unit_kerja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_kerja_id')->constrained()->onDelete('cascade');
            $table->foreignId('group_anggaran_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['unit_kerja_id', 'group_anggaran_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_anggaran_unit_kerja');
    }
};