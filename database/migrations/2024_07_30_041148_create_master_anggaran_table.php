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
        Schema::create('master_anggarans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_rekening', 50);
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
        Schema::dropIfExists('master_anggarans');
    }
};
