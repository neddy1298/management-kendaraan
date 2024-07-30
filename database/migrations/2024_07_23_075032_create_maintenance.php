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
            $table->integer('belanja_bahan_bakar_minyak')->nullable();
            $table->integer('belanja_pelumas_mesin')->nullable();
            $table->integer('belanja_suku_cadang')->nullable();
            $table->string('_token')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_maintenance');
    }
};