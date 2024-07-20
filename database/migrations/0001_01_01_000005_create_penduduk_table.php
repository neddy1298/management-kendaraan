<?php

use App\Models\KepalaKeluarga;
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
        Schema::create('tbl_penduduk', function (Blueprint $table) {
            $table->string('nik')->primary();
            $table->string('nkk');
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->char('jenis_kelamin', 20);
            $table->text('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('kelurahan_desa');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->string('agama');
            $table->string('status');
            $table->string('pekerjaan');
            $table->string('kewarganegaraan');
            $table->timestamps();

            $table->foreign('nkk')->references('nkk')->on('tbl_kepala_keluarga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_penduduk');
    }
};
