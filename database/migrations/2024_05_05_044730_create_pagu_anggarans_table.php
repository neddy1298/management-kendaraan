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
        Schema::create('pagu_anggarans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_rekening', 50);
            $table->string('nama_rekening', 100);
            $table->bigInteger('anggaran');
            $table->foreignId('anggaran_perbulan_id')->constrained('anggaran_perbulans');
            $table->integer('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagu_anggarans');
    }
};
