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
        Schema::create('tbl_belanja', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_registrasi', 10);
            $table->foreign('nomor_registrasi')
                ->references('nomor_registrasi')
                ->on('tbl_kendaraan')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('belanja_bahan_bakar_minyak');
            $table->integer('belanja_pelumas_mesin');
            $table->integer('belanja_suku_cadang');
            $table->string('keterangan'); 
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_belanja');
    }
};
