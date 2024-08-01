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
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_registrasi', 10)->unique();
            $table->string('merk_kendaraan', 100);
            $table->string('jenis_kendaraan', 20);
            $table->foreignId('unit_kerja_id')
                ->constrained('unit_kerjas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('cc_kendaraan');
            $table->string('bbm_kendaraan', 20);
            $table->string('roda_kendaraan', 20);
            $table->date('berlaku_sampai');
            $table->string('_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};
