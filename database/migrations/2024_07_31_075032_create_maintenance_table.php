<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id')
                ->constrained('kendaraans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('belanja_bahan_bakar_minyak')->nullable();
            $table->integer('belanja_pelumas_mesin')->nullable();
            $table->integer('belanja_suku_cadang')->nullable();
            $table->integer('total_belanja')->virtualAs('IFNULL(belanja_bahan_bakar_minyak, 0) + IFNULL(belanja_pelumas_mesin, 0) + IFNULL(belanja_suku_cadang, 0)');
            $table->string('_token')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};