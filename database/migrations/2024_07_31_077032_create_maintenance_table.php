<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id')
                ->constrained('kendaraans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('laporan_bulanan_id')
                ->constrained('laporan_bulanans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->date('tanggal_maintenance');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};