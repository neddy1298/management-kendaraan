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
        Schema::create('suku_cadangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('belanja_id')->constrained()->cascadeOnDelete();
            $table->foreignId('stok_suku_cadang_id')->constrained()->cascadeOnDelete();
            $table->string('nama_suku_cadang');
            $table->integer('jumlah');
            $table->bigInteger('harga_satuan');
            $table->bigInteger('total_harga')->virtualAs('jumlah * harga_satuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suku_cadangs');
    }
};
