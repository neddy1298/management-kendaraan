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
        Schema::create('unit_kerjas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_unit_kerja')->unique();
            $table->foreignId('group_anggaran_id')
                ->constrained('group_anggarans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->bigInteger('budget_bahan_bakar_minyak')->nullable();
            $table->bigInteger('budget_pelumas_mesin')->nullable();
            $table->bigInteger('budget_suku_cadang')->nullable();
            $table->bigInteger('budget_total')->virtualAs('IFNULL(budget_bahan_bakar_minyak, 0) + IFNULL(budget_pelumas_mesin, 0) + IFNULL(budget_suku_cadang, 0)');
            $table->string('_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_kerjas');
    }
};
