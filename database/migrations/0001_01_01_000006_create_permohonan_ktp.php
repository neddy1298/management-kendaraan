<?php

use App\Models\KepalaKeluarga;
use App\Models\Penduduk;
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
        Schema::create('tbl_permohonan_ktp', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('jenis_permohonan', 20);
            $table->text('keterangan');
            $table->timestamps();

            $table->foreign('nik')->references('nik')->on('tbl_penduduk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_permohonan_ktp');
    }
};
