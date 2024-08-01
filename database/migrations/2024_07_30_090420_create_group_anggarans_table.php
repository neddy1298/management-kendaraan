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
        Schema::create('group_anggarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('master_anggaran_id')
                ->constrained('master_anggarans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('kode_rekening');
            $table->string('nama_group');
            $table->bigInteger('anggaran_bahan_bakar_minyak')->nullable();
            $table->bigInteger('anggaran_pelumas_mesin')->nullable();
            $table->bigInteger('anggaran_suku_cadang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_anggarans');
    }
};
