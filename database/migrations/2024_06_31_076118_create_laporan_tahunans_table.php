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
        Schema::create('laporan_tahunans', function (Blueprint $table) {
            $table->id();
            $table->year('tahun')->unique();
            $table->foreignId('pagu_anggaran_id')->constrained()->onDelete('cascade');
            $table->bigInteger('realisasi_bahan_bakar_minyak')->nullable();
            $table->bigInteger('realisasi_pelumas_mesin')->nullable();
            $table->bigInteger('realisasi_suku_cadang')->nullable();
            $table->bigInteger('realisasi_total')->virtualAs('realisasi_bahan_bakar_minyak + realisasi_pelumas_mesin + realisasi_suku_cadang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_tahunans');
    }
};
