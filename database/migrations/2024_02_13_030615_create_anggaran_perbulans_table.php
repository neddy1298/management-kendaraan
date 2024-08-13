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
        Schema::create('anggaran_perbulans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('januari');
            $table->bigInteger('februari');
            $table->bigInteger('maret');
            $table->bigInteger('april');
            $table->bigInteger('mei');
            $table->bigInteger('juni');
            $table->bigInteger('juli');
            $table->bigInteger('agustus');
            $table->bigInteger('september');
            $table->bigInteger('oktober');
            $table->bigInteger('november');
            $table->bigInteger('desember');
            $table->bigInteger('total')->virtualAs('januari + februari + maret + april + mei + juni + juli + agustus + september + oktober + november + desember');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggaran_perbulans');
    }
};
