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
        Schema::create('tbl_desa', function (Blueprint $table) {
            $table->string('kode_desa')->primary();
            $table->string('nama_desa');
            $table->integer('kode_kecamatan');
            $table->string('nama_kecamatan');
            $table->integer('kode_kabupaten');
            $table->string('nama_kabupaten');
            $table->integer('kode_provinsi');
            $table->string('nama_provinsi');
            $table->string('alamat_kantor');
            $table->string('telepon');
            $table->string('email');
            $table->string('kode_pos');
            $table->string('nama_kepala_desa');
            $table->string('nip_kepala_desa');
            $table->string('nama_sekretaris_desa');
            $table->string('nip_sekretaris_desa');
            $table->string('nama_bendahara_desa');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_desa');
    }
};
