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
        Schema::create('tbl_group_anggaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_master_anggaran')->constrained('tbl_master_anggaran');
            $table->string('kode_rekening');
            $table->string('nama_group');
            $table->bigInteger('anggaran_bensin_pelumas');
            $table->bigInteger('anggaran_suku_cadang');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_group_anggaran');
    }
};
