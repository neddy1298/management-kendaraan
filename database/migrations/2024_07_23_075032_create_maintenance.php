<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_maintenance', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_registrasi', 10);
            $table->foreign('nomor_registrasi')
                ->references('nomor_registrasi')
                ->on('tbl_kendaraan')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('mt_group')
                ->constrained('tbl_mt_group')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_maintenance');
    }
};