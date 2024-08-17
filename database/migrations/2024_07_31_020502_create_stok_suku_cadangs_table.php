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
        Schema::create('stok_suku_cadangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_suku_cadang');
            $table->foreign('group_anggaran_id')
                ->references('id')
                ->on('group_anggarans')
                ->onDelete('cascade');
            $table->integer('stok_awal');
            $table->integer('stok');
            $table->bigInteger('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_suku_cadangs');
    }
};
