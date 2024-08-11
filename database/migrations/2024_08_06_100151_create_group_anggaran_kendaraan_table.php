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
        Schema::create('group_anggaran_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id')
                ->constrained('kendaraans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('group_anggaran_id')
                ->constrained('group_anggarans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();

            $table->unique(['kendaraan_id', 'group_anggaran_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_anggaran_kendaraan');
    }
};
