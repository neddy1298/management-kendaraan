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
        Schema::create('tbl_kepala_keluarga', function (Blueprint $table) {
            $table->string('nkk')->primary();
            $table->string('nama_kepala_keluarga');
            $table->string('rt');
            $table->string('rw');
            $table->text('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_kepala_keluarga');
    }
};
