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
        Schema::create('tbl_kendaraan', function (Blueprint $table) {
            $table->string('nomor_registrasi', 10)->primary();
            $table->string('jenis_kendaraan', 20);
            $table->integer('cc_kendaraan');
            $table->string('bbm_kendaraan', 20);
            $table->string('roda_kenda', 20);
            $table->date('berlaku_sampai');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_kendaraan');
    }
};
