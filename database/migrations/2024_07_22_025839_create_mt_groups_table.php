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
        Schema::create('tbl_mt_group', function (Blueprint $table) {
            $table->id();
            $table->string('bahan_bakar_minyak')->nullable();
            $table->string('pelumas_mesin')->nullable();
            $table->string('suku_cadang')->nullable();
            
            $table->integer('budget_bahan_bakar_minyak')->nullable();
            $table->integer('budget_pelumas_mesin')->nullable();
            $table->integer('budget_suku_cadang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_mt_group');
    }
};
