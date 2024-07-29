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
        Schema::create('tbl_anggaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_master_anggaran')->constrained('tbl_master_anggaran');
            $table->string('kode_rekening', 50)->unique();
            $table->string('nama_rekening', 100);
            $table->bigInteger('anggaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_anggaran');
    }
};
