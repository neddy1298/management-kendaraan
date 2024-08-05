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
        Schema::create('laporan_bulanans', function (Blueprint $table) {
            $table->id();
            $table->integer('bulan');
            $table->foreignId('laporan_tahunan_id')->constrained()->onDelete('cascade');
            $table->bigInteger('anggaran_bahan_bakar_minyak')->nullable();
            $table->bigInteger('anggaran_pelumas_mesin')->nullable();
            $table->bigInteger('anggaran_suku_cadang')->nullable();
            $table->bigInteger('anggaran_total')->virtualAs('anggaran_bahan_bakar_minyak + anggaran_pelumas_mesin + anggaran_suku_cadang');
            $table->bigInteger('realisasi_bahan_bakar_minyak')->nullable();
            $table->bigInteger('realisasi_pelumas_mesin')->nullable();
            $table->bigInteger('realisasi_suku_cadang')->nullable();
            $table->bigInteger('realisasi_total')->virtualAs('realisasi_bahan_bakar_minyak + realisasi_pelumas_mesin + realisasi_suku_cadang');
            $table->bigInteger('sisa_anggaran')->virtualAs('anggaran_total - realisasi_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_bulanans');
    }
};
